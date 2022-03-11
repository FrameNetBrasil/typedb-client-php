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
use Typedb\Protocol\TransactionProto;

import java.util.Iterator;
import java.util.NoSuchElementException;
import java.util.UUID;

use TypeDb\Client.common.exception.ErrorMessage.Client.MISSING_RESPONSE;
use TypeDb\Client.common.exception.ErrorMessage.Internal.ILLEGAL_ARGUMENT;
use TypeDb\Client.common.exception.ErrorMessage.Internal.ILLEGAL_STATE;

class ResponsePartIterator implements Iterator<TransactionProto.Transaction.ResPart>{

    private  UUID requestID;
    private  BidirectionalStream stream;
    private  ResponseCollector.Queue<TransactionProto.Transaction.ResPart> responseCollector;
    private TransactionProto.Transaction.ResPart next;
    private State state;

    enum State {EMPTY, FETCHED, DONE}

    public function requestID, ResponseCollector.Queue<TransactionProto.Transaction.ResPart> responseQueue,
                                BidirectionalStream stream) : ResponsePartIterator(UUID{
        this.requestID = requestID;
        this.stream = stream;
        this.responseCollector = responseQueue;
        state = State.EMPTY;
        next = null;
    }

    private bool fetchAndCheck() {
        TransactionProto.Transaction.ResPart resPart = responseCollector.take();
        switch (resPart.getResCase()) {
            case RES_NOT_SET:
                throw new TypeDBClientException(MISSING_RESPONSE, requestID);
            case STREAM_RES_PART:
                switch (resPart.getStreamResPart().getState()) {
                    case DONE:
                        state = State.DONE;
                        return false;
                    case CONTINUE:
                        stream.dispatcher().dispatch(RequestBuilder.Transaction.streamReq(requestID));
                        return fetchAndCheck();
                    default:
                        throw new TypeDBClientException(ILLEGAL_ARGUMENT);
                }
            default:
                next = resPart;
                state = State.FETCHED;
                return true;
        }
    }

    
    public function hasNext() : bool{
        switch (state) {
            case DONE:
                return false;
            case FETCHED:
                return true;
            case EMPTY:
                return fetchAndCheck();
            default:
                throw new TypeDBClientException(ILLEGAL_STATE);
        }
    }

    
    public function next() : TransactionProto.Transaction.ResPart{
        if (stream.getError().isPresent()) throw TypeDBClientException.of(stream.getError().get());
        else if (!hasNext()) throw new NoSuchElementException();
        else {
            state = State.EMPTY;
            return next;
        }
    }
}
