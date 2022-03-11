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

import com.google.protobuf.Bytestring;
use TypeDb\Client.common.exception.TypeDBClientException;
use TypeDb\Client.common.rpc.TypeDBStub;
use Typedb\Protocol\TransactionProto.Transaction.Req;
use Typedb\Protocol\TransactionProto.Transaction.Res;
use Typedb\Protocol\TransactionProto.Transaction.ResPart;
use Typedb\Protocol\TransactionProto.Transaction.Server;
import io.grpc.StatusRuntimeException;
import io.grpc.stub.StreamObserver;

import javax.annotation.Nullable;
import java.util.Optional;
import java.util.UUID;
import java.util.concurrent.atomic.AtomicBoolean;
import java.util.stream.Stream;
import java.util.stream.StreamSupport;

use TypeDb\Client.common.collection.Bytes.bytesToUUID;
use TypeDb\Client.common.exception.ErrorMessage.Client.UNKNOWN_REQUEST_ID;
use TypeDb\Client.common.exception.ErrorMessage.Internal.ILLEGAL_ARGUMENT;
use TypeDb\Client.common.rpc.RequestBuilder.UUIDAsBytestring;
import static java.util.Spliterator.IMMUTABLE;
import static java.util.Spliterator.ORDERED;
import static java.util.Spliterators.spliteratorUnknownSize;

class BidirectionalStream implements AutoCloseable{

    private  ResponseCollector<Res> resCollector;
    private  ResponseCollector<ResPart> resPartCollector;
    private  RequestTransmitter.Dispatcher dispatcher;
    private  AtomicBoolean isOpen;
    private StatusRuntimeException error;

    public function stub, RequestTransmitter transmitter) : BidirectionalStream(TypeDBStub{
        resPartCollector = new ResponseCollector<>();
        resCollector = new ResponseCollector<>();
        isOpen = new AtomicBoolean(false);
        dispatcher = transmitter.dispatcher(stub.transaction(new ResponseObserver()));
        isOpen.set(true);
        error = null;
    }

    public function single(Req.Builder request, bool batch) : Single<Res>{
        UUID requestID = UUID.randomUUID();
        Req req = request.setReqId(UUIDAsBytestring(requestID)).build();
        ResponseCollector.Queue<Res> queue = resCollector.queue(requestID);
        if (batch) dispatcher.dispatch(req);
        else dispatcher.dispatchNow(req);
        return new Single<>(queue);
    }

    public function stream(Req.Builder request) : Stream<ResPart>{
        UUID requestID = UUID.randomUUID();
        ResponseCollector.Queue<ResPart> collector = resPartCollector.queue(requestID);
        dispatcher.dispatch(request.setReqId(UUIDAsBytestring(requestID)).build());
        ResponsePartIterator iterator = new ResponsePartIterator(requestID, collector, this);
        return StreamSupport.stream(spliteratorUnknownSize(iterator, ORDERED | IMMUTABLE), false);
    }

    public function isOpen() : bool{
        return isOpen.get();
    }

    private void collect(Res res) {
        UUID requestID = bytestringAsUUID(res.getReqId());
        ResponseCollector.Queue<Res> collector = resCollector.get(requestID);
        if (collector != null) collector.put(res);
        else throw new TypeDBClientException(UNKNOWN_REQUEST_ID, requestID, res);
    }

    private void collect(ResPart resPart) {
        UUID requestID = bytestringAsUUID(resPart.getReqId());
        ResponseCollector.Queue<ResPart> collector = resPartCollector.get(requestID);
        if (collector != null) collector.put(resPart);
        else throw new TypeDBClientException(UNKNOWN_REQUEST_ID, requestID, resPart);
    }

    private static UUID bytestringAsUUID(Bytestring bytestring) {
        return bytesToUUID(bytestring.toByteArray());
    }

    
    public function close() : void{
        close(null);
    }

    private void close( StatusRuntimeException error) {
        if (isOpen.compareAndSet(true, false)) {
            this.error = error;
            resCollector.close(error);
            resPartCollector.close(error);
            try {
                dispatcher.close();
            } catch (StatusRuntimeException e) {
                throw TypeDBClientException.of(e);
            }
        }
    }

    public function getError() : StatusRuntimeException | null{
        return Optional.ofNullable(error);
    }

    RequestTransmitter.Dispatcher dispatcher() {
        return dispatcher;
    }

    public function class Single<T> : static{

        private  ResponseCollector.Queue<T> queue;

        public function queue) : Single(ResponseCollector.Queue<T>{
            this.queue = queue;
        }

        public function get() : T{
            return queue.take();
        }
    }

    private class ResponseObserver implements StreamObserver<Server> {

        
        public function onNext(Server serverMsg) : void{
            if (!isOpen.get()) return;

            switch (serverMsg.getServerCase()) {
                case RES:
                    collect(serverMsg.getRes());
                    break;
                case RES_PART:
                    collect(serverMsg.getResPart());
                    break;
                default:
                case SERVER_NOT_SET:
                    throw new TypeDBClientException(ILLEGAL_ARGUMENT);
            }
        }

        
        public function onError(Throwable t) : void{
            assert t instanceof StatusRuntimeException : "The server sent an exception of unexpected type " + t.getClass();
            // TODO: this isn't nice - an error from one request isn't really appropriate for all of them (see #180)
            close((StatusRuntimeException) t);
        }

        
        public function onCompleted() : void{
            close();
        }
    }
}
