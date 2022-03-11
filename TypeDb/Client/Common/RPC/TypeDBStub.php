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

namespace TypeDb\Client\Common\RPC;

use TypeDb\Client.common.exception.TypeDBClientException;
use Typedb\Protocol\CoreDatabaseProto;
use Typedb\Protocol\SessionProto;
use Typedb\Protocol\TransactionProto;
use Typedb\Protocol\TypeDBGrpc;
import io.grpc.ConnectivityState;
import io.grpc.ManagedChannel;
import io.grpc.StatusRuntimeException;
import io.grpc.stub.StreamObserver;

import java.util.function.Supplier;

public function class TypeDBStub : abstract{

    public function databasesContains(CoreDatabaseProto.CoreDatabaseManager.Contains.Req request) : CoreDatabaseProto.CoreDatabaseManager.Contains.Res{
        return resilientCall(() -> blockingStub().databasesContains(request));
    }

    public function databasesCreate(CoreDatabaseProto.CoreDatabaseManager.Create.Req request) : CoreDatabaseProto.CoreDatabaseManager.Create.Res{
        return resilientCall(() -> blockingStub().databasesCreate(request));
    }

    public function databasesAll(CoreDatabaseProto.CoreDatabaseManager.All.Req request) : CoreDatabaseProto.CoreDatabaseManager.All.Res{
        return resilientCall(() -> blockingStub().databasesAll(request));
    }

    public function databaseSchema(CoreDatabaseProto.CoreDatabase.Schema.Req request) : CoreDatabaseProto.CoreDatabase.Schema.Res{
        return resilientCall(() -> blockingStub().databaseSchema(request));
    }

    public function databaseDelete(CoreDatabaseProto.CoreDatabase.Delete.Req request) : CoreDatabaseProto.CoreDatabase.Delete.Res{
        return resilientCall(() -> blockingStub().databaseDelete(request));
    }

    public function sessionOpen(SessionProto.Session.Open.Req request) : SessionProto.Session.Open.Res{
        return resilientCall(() -> blockingStub().sessionOpen(request));
    }

    public function sessionClose(SessionProto.Session.Close.Req request) : SessionProto.Session.Close.Res{
        return resilientCall(() -> blockingStub().sessionClose(request));
    }

    public function sessionPulse(SessionProto.Session.Pulse.Req request) : SessionProto.Session.Pulse.Res{
        return resilientCall(() -> blockingStub().sessionPulse(request));
    }

    public function transaction(StreamObserver<TransactionProto.Transaction.Server> responseObserver) : StreamObserver<TransactionProto.Transaction.Client>{
        return resilientCall(() -> asyncStub().transaction(responseObserver));
    }

    protected abstract ManagedChannel channel();

    protected abstract TypeDBGrpc.TypeDBBlockingStub blockingStub();

    protected abstract TypeDBGrpc.TypeDBStub asyncStub();

    protected <RES> RES resilientCall(Supplier<RES> function) {
        try {
            ensureConnected();
            return function.get();
        } catch (StatusRuntimeException e) {
            throw TypeDBClientException.of(e);
        }
    }

    private void ensureConnected() {
        // The Channel is a persistent HTTP connection. If it gets interrupted (say, by the server going down) then
        // gRPC's recovery logic will kick in, marking the Channel as being in a transient failure state and rejecting
        // all RPC calls while in this state. It will attempt to reconnect periodically in the background, using an
        // exponential backoff algorithm. Here, we ensure that when the user needs that connection urgently (e.g: to
        // open a TypeDB session), it tries to reconnect immediately instead of just failing without trying.
        if (channel().getState(true).equals(ConnectivityState.TRANSIENT_FAILURE)) {
            channel().resetConnectBackoff();
        }
    }
}
