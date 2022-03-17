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

/*
package com.vaticle.typedb.client.connection;

import com.google.protobuf.ByteString;
import com.vaticle.typedb.client.api.TypeDBOptions;
import com.vaticle.typedb.client.api.TypeDBTransaction;
import com.vaticle.typedb.client.api.concept.ConceptManager;
import com.vaticle.typedb.client.api.logic.LogicManager;
import com.vaticle.typedb.client.api.query.QueryFuture;
import com.vaticle.typedb.client.api.query.QueryManager;
import com.vaticle.typedb.client.common.exception.TypeDBClientException;
import com.vaticle.typedb.client.concept.ConceptManagerImpl;
import com.vaticle.typedb.client.logic.LogicManagerImpl;
import com.vaticle.typedb.client.query.QueryManagerImpl;
import com.vaticle.typedb.client.stream.BidirectionalStream;
import com.vaticle.typedb.protocol.TransactionProto.Transaction.Req;
import com.vaticle.typedb.protocol.TransactionProto.Transaction.Res;
import com.vaticle.typedb.protocol.TransactionProto.Transaction.ResPart;
import io.grpc.StatusRuntimeException;

import java.util.Optional;
import java.util.stream.Stream;

import static com.vaticle.typedb.client.common.exception.ErrorMessage.Client.TRANSACTION_CLOSED;
import static com.vaticle.typedb.client.common.exception.ErrorMessage.Client.TRANSACTION_CLOSED_WITH_ERRORS;
import static com.vaticle.typedb.client.common.rpc.RequestBuilder.Transaction.commitReq;
import static com.vaticle.typedb.client.common.rpc.RequestBuilder.Transaction.openReq;
import static com.vaticle.typedb.client.common.rpc.RequestBuilder.Transaction.rollbackReq;
*/

namespace TypeDb\Client\Connection;

use Symfony\Component\String\ByteString;
use TypeDb\Client\Api\Concept\ConceptManager;
use TypeDb\Client\Api\Logic\LogicManager;
use TypeDb\Client\Api\Query\QueryManager;
use TypeDb\Client\Api\TypeDBOptions;
use TypeDb\Client\Api\TypeDBTransactionExtend;
use TypeDb\Client\Api\TypeDBTransactionType;
use TypeDb\Client\Stream\BidirectionalStream;
use TypeDb\Client\Api\TypeDbTransactionType as Type;

use Typedb\Protocol\Transaction\Req;
use Typedb\Protocol\Transaction\Res;
use Typedb\Protocol\Transaction\ResPart;

class TypeDBTransactionImpl implements TypeDBTransactionExtend
{

    private Type $type;
    private TypeDBOptions $options;
    private ConceptManager $conceptMgr;
    private LogicManager $logicMgr;
    private QueryManager $queryMgr;

    private BidirectionalStream $bidirectionalStream;

    public function __construct(TypeDBSessionImpl $session, ByteString $sessionId, Type $type, TypeDBOptions $options)
    {
        $this->type = $type;
        $this->options = $options;
//        $this->conceptMgr = new ConceptManagerImpl($this);
//        $this->logicMgr = new LogicManagerImpl($this);
//        $this->queryMgr = new QueryManagerImpl($this);
        $this->bidirectionalStream = new BidirectionalStream($session->stub(), $session->transmitter());
//execute(openReq(sessionId, type.proto(), options.proto(), session.networkLatencyMillis()), false);
    }

    public function type(): Type {
        return $this->type;
    }

public function options(): TypeDBOptions  {
        return $this->options;
    }

    public function isOpen(): bool {
        return $this->bidirectionalStream->isOpen();
    }

    public function concepts(): ConceptManager  {
        return $this->conceptMgr;
    }

    public function logic(): LogicManager  {
        return $this->logicMgr;
    }

    public function query(): QueryManager  {
        return $this->queryMgr;
    }

    private function execute(Req $request, bool $batch=true): Res {
        return $this->query_($request, $batch)->get();
    }

    private function query_(Req $request, bool $batch=true): Res  {
//    if (!isOpen()) throwTransactionClosed();
        $single = $this->bidirectionalStream->single($request, $batch);
        return $single::get;
    }

    public function stream(Req $request) {
//    if (!isOpen()) throwTransactionClosed();
    return $this->bidirectionalStream->stream($request);
}

    private function throwTransactionClosed(): void {
//Optional<StatusRuntimeException> error = bidirectionalStream.getError();
//        if (error.isPresent()) throw new TypeDBClientException(TRANSACTION_CLOSED_WITH_ERRORS, error.get());
//        else throw new TypeDBClientException(TRANSACTION_CLOSED);
    }

    public function commit(): void {
//        try {
//            execute(commitReq());
//        } finally {
//            close();
//        }
    }

    public function rollback(): void {
//execute(rollbackReq());
    }

    public function close(): void {
    $this->bidirectionalStream->close();
    }

    /*

    private final TypeDBTransaction.Type type;
    private final TypeDBOptions options;
    private final ConceptManager conceptMgr;
    private final LogicManager logicMgr;
    private final QueryManager queryMgr;

    private final BidirectionalStream bidirectionalStream;

    TypeDBTransactionImpl(TypeDBSessionImpl session, ByteString sessionId, Type type, TypeDBOptions options) {
        this.type = type;
        this.options = options;
        conceptMgr = new ConceptManagerImpl(this);
        logicMgr = new LogicManagerImpl(this);
        queryMgr = new QueryManagerImpl(this);
        bidirectionalStream = new BidirectionalStream(session.stub(), session.transmitter());
        execute(openReq(sessionId, type.proto(), options.proto(), session.networkLatencyMillis()), false);
    }

    @Override
    public Type type() {
        return type;
    }

    @Override
    public TypeDBOptions options() {
        return options;
    }

    @Override
    public boolean isOpen() {
        return bidirectionalStream.isOpen();
    }

    @Override
    public ConceptManager concepts() {
        return conceptMgr;
    }

    @Override
    public LogicManager logic() {
        return logicMgr;
    }

    @Override
    public QueryManager query() {
        return queryMgr;
    }

    @Override
    public Res execute(Req.Builder request) {
        return execute(request, true);
    }

    private Res execute(Req.Builder request, boolean batch) {
        return query(request, batch).get();
    }

    @Override
    public QueryFuture<Res> query(Req.Builder request) {
        return query(request, true);
    }

    private QueryFuture<Res> query(Req.Builder request, boolean batch) {
        if (!isOpen()) throwTransactionClosed();
        BidirectionalStream.Single<Res> single = bidirectionalStream.single(request, batch);
        return single::get;
    }

    @Override
    public Stream<ResPart> stream(Req.Builder request) {
        if (!isOpen()) throwTransactionClosed();
        return bidirectionalStream.stream(request);
    }

    private void throwTransactionClosed() {
        Optional<StatusRuntimeException> error = bidirectionalStream.getError();
        if (error.isPresent()) throw new TypeDBClientException(TRANSACTION_CLOSED_WITH_ERRORS, error.get());
        else throw new TypeDBClientException(TRANSACTION_CLOSED);
    }

    @Override
    public void commit() {
        try {
            execute(commitReq());
        } finally {
            close();
        }
    }

    @Override
    public void rollback() {
        execute(rollbackReq());
    }

    @Override
    public void close() {
        bidirectionalStream.close();
    }
    */
}
