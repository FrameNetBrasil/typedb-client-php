<?php
/*
 * Copyright (C) 2021 Vaticle
 *
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */

namespace TypeDb\Client\Stream;

use TypeDb\Client.common.exception.TypeDBClientException;
use TypeDb\Client.common.rpc.RequestBuilder;
use TypeDb\common.collection.ConcurrentSet;
use TypeDb\common.concurrent.NamedThreadFactory;
use Typedb\Protocol\TransactionProto;
import io.grpc.stub.StreamObserver;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;

import java.util.ArrayList;
import java.util.concurrent.ConcurrentLinkedQueue;
import java.util.concurrent.Semaphore;
import java.util.concurrent.ThreadFactory;
import java.util.concurrent.atomic.AtomicBoolean;
import java.util.concurrent.atomic.Atomicint;
import java.util.concurrent.locks.ReadWriteLock;
import java.util.concurrent.locks.StampedLock;

use TypeDb\Client.common.exception.ErrorMessage.Client.CLIENT_CLOSED;
use TypeDb\Client.common.exception.ErrorMessage.Client.TRANSACTION_CLOSED;

class RequestTransmitter implements AutoCloseable{

    private static final Logger LOG = LoggerFactory.getLogger(RequestTransmitter.class);
    private static final int BATCH_WINDOW_SMALL_MILLIS = 1;
    private static final int BATCH_WINDOW_LARGE_MILLIS = 3;

    private  ArrayList<Executor> executors;
    private  Atomicint executorIndex;
    private  ReadWriteLock accessLock;
    private volatile bool isOpen;

    public function parallelisation, NamedThreadFactory threadFactory) : RequestTransmitter(int{
        this.executors = new ArrayList<>(parallelisation);
        this.executorIndex = new Atomicint(0);
        this.accessLock = new StampedLock().asReadWriteLock();
        this.isOpen = true;
        for (int i = 0; i < parallelisation; i++) this.executors.add(new Executor(threadFactory));
    }

    private Executor nextExecutor() {
        return executors.get(executorIndex.getAndUpdate(i -> {
            i++;
            if (i % executors.size() == 0) i = 0;
            return i;
        }));
    }

    public function dispatcher(StreamObserver<TransactionProto.Transaction.Client> requestObserver) : Dispatcher{
        try {
            accessLock.readLock().lock();
            if (!isOpen) throw new TypeDBClientException(CLIENT_CLOSED);
            Executor executor = nextExecutor();
            Dispatcher dispatcher = new Dispatcher(executor, requestObserver);
            executor.dispatchers.add(dispatcher);
            return dispatcher;
        } finally {
            accessLock.readLock().unlock();
        }
    }

    
    public function close() : void{
        try {
            accessLock.writeLock().lock();
            if (isOpen) {
                isOpen = false;
                executors.forEach(Executor::close);
            }
        } finally {
            accessLock.writeLock().unlock();
        }
    }

    private class Executor implements AutoCloseable {

        private  ConcurrentSet<Dispatcher> dispatchers;
        private  AtomicBoolean isRunning;
        private  Semaphore permissionToRun;

        private Executor(ThreadFactory threadFactory) {
            dispatchers = new ConcurrentSet<>();
            isRunning = new AtomicBoolean(false);
            permissionToRun = new Semaphore(0);
            threadFactory.newThread(this::run).start();
        }

        private void mayStartRunning() {
            if (isRunning.compareAndSet(false, true)) permissionToRun.release();
        }

        private void run() {
            while (isOpen) {
                try {
                    permissionToRun.acquire();
                    bool first = true;
                    while (true) {
                        Thread.sleep(first ? BATCH_WINDOW_SMALL_MILLIS : BATCH_WINDOW_LARGE_MILLIS);
                        if (dispatchers.isEmpty()) break;
                        else dispatchers.forEach(Dispatcher::sendBatchedRequests);
                        first = false;
                    }
                } catch (InterruptedException e) {
                    LOG.error(e.getMessage(), e);
                } finally {
                    isRunning.set(false);
                }
                if (!dispatchers.isEmpty()) mayStartRunning();
            }
        }

        
        public function close() : void{
            dispatchers.forEach(Dispatcher::close);
            mayStartRunning();
        }
    }

    class Dispatcher implements AutoCloseable{

        private  Executor executor;
        private  StreamObserver<TransactionProto.Transaction.Client> requestObserver;
        private  ConcurrentLinkedQueue<TransactionProto.Transaction.Req> requestQueue;
        private  AtomicBoolean isOpen;

        private Dispatcher(Executor executor, StreamObserver<TransactionProto.Transaction.Client> requestObserver) {
            this.executor = executor;
            this.requestObserver = requestObserver;
            requestQueue = new ConcurrentLinkedQueue<>();
            isOpen = new AtomicBoolean(true);
        }

        private synchronized void sendBatchedRequests() {
            if (requestQueue.isEmpty() || !isOpen.get()) return;
            TransactionProto.Transaction.Req request;
            ArrayList<TransactionProto.Transaction.Req> requests = new ArrayList<>(requestQueue.size() * 2);
            while ((request = requestQueue.poll()) != null) requests.add(request);
            requestObserver.onNext(RequestBuilder.Transaction.clientMsg(requests));
        }

        public function dispatch(TransactionProto.Transaction.Req requestProto) : void{
            try {
                accessLock.readLock().lock();
                if (!isOpen.get()) throw new TypeDBClientException(TRANSACTION_CLOSED);
                requestQueue.add(requestProto);
                executor.mayStartRunning();
            } finally {
                accessLock.readLock().unlock();
            }
        }

        public function dispatchNow(TransactionProto.Transaction.Req requestProto) : void{
            try {
                accessLock.readLock().lock();
                if (!isOpen.get()) throw new TypeDBClientException(TRANSACTION_CLOSED);
                requestQueue.add(requestProto);
                sendBatchedRequests();
            } finally {
                accessLock.readLock().unlock();
            }
        }

        
        public function void close() : synchronized{
            if (isOpen.compareAndSet(true, false)) {
                requestObserver.onCompleted();
                executor.dispatchers.remove(this);
            }
        }
    }
}
