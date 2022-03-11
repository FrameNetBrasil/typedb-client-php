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
use TypeDb\common.collection.Either;
import io.grpc.StatusRuntimeException;

import javax.annotation.Nullable;
import java.util.UUID;
import java.util.concurrent.BlockingQueue;
import java.util.concurrent.ConcurrentHashMap;
import java.util.concurrent.ConcurrentMap;
import java.util.concurrent.LinkedTransferQueue;

use TypeDb\Client.common.exception.ErrorMessage.Client.TRANSACTION_CLOSED;
use TypeDb\Client.common.exception.ErrorMessage.Client.TRANSACTION_CLOSED_WITH_ERRORS;
use TypeDb\Client.common.exception.ErrorMessage.Internal.UNEXPECTED_INTERRUPTION;

class ResponseCollector<R>{

    private  ConcurrentMap<UUID, Queue<R>> collectors;

    public function : ResponseCollector(){
        collectors = new ConcurrentHashMap<>();
    }

    synchronized Queue<R> queue(UUID requestId) {
        Queue<R> collector = new Queue<>();
        collectors.put(requestId, collector);
        return collector;
    }

    Queue<R> get(UUID requestId) {
        return collectors.get(requestId);
    }

    synchronized void close( StatusRuntimeException error) {
        collectors.values().forEach(collector -> collector.close(error));
    }

    public function class Queue<R> : static{

        private  BlockingQueue<Either<Response<R>, Done>> responseQueue;
        private StatusRuntimeException error;

        Queue() {
            // TODO: switch LinkedTransferQueue to LinkedBlockingQueue once issue #351 is fixed
            responseQueue = new LinkedTransferQueue<>();
            error = null;
        }

        public function take() : R{
            try {
                Either<Response<R>, Done> response = responseQueue.take();
                if (response.isFirst()) return response.first().message();
                else if (this.error != null) throw new TypeDBClientException(TRANSACTION_CLOSED_WITH_ERRORS, error);
                else throw new TypeDBClientException(TRANSACTION_CLOSED);
            } catch (InterruptedException e) {
                throw new TypeDBClientException(UNEXPECTED_INTERRUPTION);
            }
        }

        public function put(R response) : void{
            responseQueue.add(Either.first(new Response<>(response)));
        }

        public function close( StatusRuntimeException error) : void{
            this.error = error;
            responseQueue.add(Either.second(new Done()));
        }

        private static class Response<R> {

            
            private  R value;

            private Response( R value) {
                this.value = value;
            }

            
            private R message() {
                return value;
            }
        }

        private static class Done {
            private Done() {
            }
        }
    }
}
