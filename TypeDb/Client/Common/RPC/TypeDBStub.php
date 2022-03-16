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

/*
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
*/
use TypeDb\Client\Common\RPC\TypeDBStub;

use Typedb\Protocol\CoreDatabaseManager\Create\Req as CreateReq;
use Typedb\Protocol\CoreDatabaseManager\Create\Res as CreateRes;
use Typedb\Protocol\CoreDatabaseManager\Contains\Req as ContainsReq;
use Typedb\Protocol\CoreDatabaseManager\Contains\Res as ContainsRes;
use Typedb\Protocol\CoreDatabaseManager\All\Req as AllReq;
use Typedb\Protocol\CoreDatabaseManager\All\Res as AllRes;


class TypeDBStub {

    public function databasesContains(ContainsReq $request) : ContainsRes {
        return $this->blockingStub()->databases_contains($request);
    }

    public function databasesCreate(CreateReq $request) : CreateRes{
        return $this->blockingStub()->databases_create($request);
    }

    public function databasesAll(AllReq $request) : AllRes{
        return $this->blockingStub()->databases_zll($request);
    }

    public function databaseSchema(SchemaReq $request) : SchemaRes{
        return $this->blockingStub()->database_schema($request);
    }

    public function databaseDelete(DeleteReq $request) : DeleteRes{
        return $this->blockingStub()->database_delete($request));
    }

    public function sessionOpen(Open.Req $request) : SessionProto.Session.Open.Res{
        return $this->blockingStub()->session_open($request));
    }

    public function sessionClose(SessionProto.Session.Close.Req $request) : SessionProto.Session.Close.Res{
        return $this->blockingStub()->session_close($request));
    }

    public function sessionPulse(SessionProto.Session.Pulse.Req $request) : SessionProto.Session.Pulse.Res{
        return $this->blockingStub()->session_pulse($request));
    }

    public function transaction(StreamObserver<TransactionProto.Transaction.Server> responseObserver) : StreamObserver<TransactionProto.Transaction.Client>{
        return $this->asyncStub()->transaction(responseObserver));
    }

    protected function  blockingStub(): TypeDBStub;

    protected function asyncStub():TypeDBStub;

    /*
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
    */
}
