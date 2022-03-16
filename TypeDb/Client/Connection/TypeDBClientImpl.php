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

namespace TypeDb\Client\Connection;
use TypeDb\Client\Api\TypeDBClient;
use TypeDb\Client\Common\RPC\ManagedChannel;
use TypeDb\Client\Stream\RequestTransmitter;

/*
package com.vaticle.typedb.client.connection;

import com.google.protobuf.ByteString;
import com.vaticle.typedb.client.api.TypeDBClient;
import com.vaticle.typedb.client.api.TypeDBOptions;
import com.vaticle.typedb.client.api.TypeDBSession;
import com.vaticle.typedb.client.common.exception.TypeDBClientException;
import com.vaticle.typedb.client.common.rpc.TypeDBStub;
import com.vaticle.typedb.client.stream.RequestTransmitter;
import com.vaticle.typedb.common.concurrent.NamedThreadFactory;
import io.grpc.ManagedChannel;

import java.util.concurrent.ConcurrentHashMap;
import java.util.concurrent.ConcurrentMap;
import java.util.concurrent.TimeUnit;

import static com.vaticle.typedb.client.common.exception.ErrorMessage.Internal.ILLEGAL_CAST;
import static com.vaticle.typedb.common.util.Objects.className;
*/

abstract class TypeDBClientImpl implements TypeDBClient {

    private static string $TYPEDB_CLIENT_RPC_THREAD_NAME = "typedb-client-rpc";

    private RequestTransmitter $transmitter;
    private TypeDBDatabaseManagerImpl $databaseMgr;
//    private final ConcurrentMap<ByteString, TypeDBSessionImpl> sessions;

    public function __construct(int $parallelisation) {
//        NamedThreadFactory threadFactory = NamedThreadFactory.create(TYPEDB_CLIENT_RPC_THREAD_NAME);
//        transmitter = new RequestTransmitter(parallelisation, threadFactory);
//        databaseMgr = new TypeDBDatabaseManagerImpl(this);
//        sessions = new ConcurrentHashMap<>();
    }

    public function calculateParallelisation(): int {
//        int cores = Runtime.getRuntime().availableProcessors();
//        if (cores <= 4) return 2;
//        else if (cores <= 9) return 3;
//        else if (cores <= 16) return 4;
//        else return (int) Math.ceil(cores / 4.0);
    }

    protected function validateConnectionOrThrow(): void { // throws TypeDBClientException { // TODO: we should throw checked exception
        try {
            // TODO: This is hacky patch. We know that databaseMgr.all() will throw an exception if connection has not been
            //       established. But we should replace this code to perform the check in a more meaningful way. This method
            //       should naturally be replaced once we implement a new client pulse architecture.
            $this->databaseMgr.all();
        } catch (\Exception $e){
            $this->close();
            throw $e;
        }
    }

    public function isOpen(): bool {
        return !$this->channel().isShutdown();
    }

    public function TypeDBSessionImpl session(String database, TypeDBSession.Type type): TypeDBSessionImpl  {
        return $this->session(database, type, TypeDBOptions.core());
    }

    public function  session(String database, TypeDBSession.Type type, TypeDBOptions options): TypeDBSessionImpl  {
       $session = new TypeDBSessionImpl(this, database, type, options);
//        assert !sessions.containsKey(session.id());
//        sessions.put(session.id(), session);
//        return session;
    }

    public function  databases() : TypeDBDatabaseManagerImpl {
        return $this->databaseMgr;
    }

    public function  isCluster() : bool{
        return false;
    }

    public function  asCluster(): Cluster  {
        throw new TypeDBClientException(ILLEGAL_CAST, className(TypeDBClient.Cluster.class));
    }

    abstract public function channel(): ManagedChannel ;

    abstract public function stub():TypeDBStub ;

    public function transmitter(): RequestTransmitter  {
        return $this->transmitter;
    }

    public function removeSession(TypeDBSessionImpl session): void {
        $this->sessions.remove(session.id());
    }

    public function close(): void {
        try {
//            sessions.values().forEach(TypeDBSessionImpl::close);
//            channel().shutdown().awaitTermination(10, TimeUnit.SECONDS);
//            transmitter.close();
        } catch (InterruptedException e) {
//            Thread.currentThread().interrupt();
        }
    }

}
