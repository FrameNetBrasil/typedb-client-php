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
namespace TypeDb\Client\Query;

use TypeDb\Client.api.TypeDBOptions;
use TypeDb\Client.api.TypeDBTransaction;
use TypeDb\Client\Api\Answer.ConceptMap;
use TypeDb\Client\Api\Answer.ConceptMapGroup;
use TypeDb\Client\Api\Answer.Numeric;
use TypeDb\Client\Api\Answer.NumericGroup;
use TypeDb\Client.api.logic.Explanation;
use TypeDb\Client.api.query.QueryFuture;
use TypeDb\Client.api.query.QueryManager;
use TypeDb\Client.concept.answer.ConceptMapGroupImpl;
use TypeDb\Client.concept.answer.ConceptMapImpl;
use TypeDb\Client.concept.answer.NumericGroupImpl;
use TypeDb\Client.concept.answer.NumericImpl;
use TypeDb\Client.logic.ExplanationImpl;
use Typedb\Protocol\QueryProto;
use Typedb\Protocol\TransactionProto;
import com.vaticle.typeql.lang.query.TypeQLDefine;
import com.vaticle.typeql.lang.query.TypeQLDelete;
import com.vaticle.typeql.lang.query.TypeQLInsert;
import com.vaticle.typeql.lang.query.TypeQLMatch;
import com.vaticle.typeql.lang.query.TypeQLUndefine;
import com.vaticle.typeql.lang.query.TypeQLUpdate;

import java.util.stream.Stream;

use TypeDb\Client.common.rpc.RequestBuilder.QueryManager.defineReq;
use TypeDb\Client.common.rpc.RequestBuilder.QueryManager.deleteReq;
use TypeDb\Client.common.rpc.RequestBuilder.QueryManager.explainReq;
use TypeDb\Client.common.rpc.RequestBuilder.QueryManager.insertReq;
use TypeDb\Client.common.rpc.RequestBuilder.QueryManager.matchAggregateReq;
use TypeDb\Client.common.rpc.RequestBuilder.QueryManager.matchGroupAggregateReq;
use TypeDb\Client.common.rpc.RequestBuilder.QueryManager.matchGroupReq;
use TypeDb\Client.common.rpc.RequestBuilder.QueryManager.matchReq;
use TypeDb\Client.common.rpc.RequestBuilder.QueryManager.undefineReq;
use TypeDb\Client.common.rpc.RequestBuilder.QueryManager.updateReq;
*/
class QueryManagerImpl implements QueryManager {
/*
    private  TypeDBTransaction.Extended transactionExt;

    public function transactionExt) : QueryManagerImpl(TypeDBTransaction.Extended{
        this.transactionExt = transactionExt;
    }

    
    public function match(TypeQLMatch query) : Stream<ConceptMap>{
        return match(query.tostring());
    }

    
    public function match(TypeQLMatch query, TypeDBOptions options) : Stream<ConceptMap>{
        return match(query.tostring(), options);
    }

    
    public function match(string query) : Stream<ConceptMap>{
        return match(query, TypeDBOptions.core());
    }

    
    public function match(string query, TypeDBOptions options) : Stream<ConceptMap>{
        return stream(matchReq(query, options.proto()))
                .flatMap(rp -> rp.getMatchResPart().getAnswersList().stream())
                .map(ConceptMapImpl::of);
    }

    
    public function match(TypeQLMatch.Aggregate query) : QueryFuture<Numeric>{
        return matchAggregate(query.tostring());
    }

    
    public function match(TypeQLMatch.Aggregate query, TypeDBOptions options) : QueryFuture<Numeric>{
        return matchAggregate(query.tostring(), options);
    }

    
    public function matchAggregate(string query) : QueryFuture<Numeric>{
        return matchAggregate(query, TypeDBOptions.core());
    }

    
    public function matchAggregate(string query, TypeDBOptions options) : QueryFuture<Numeric>{
        return query(matchAggregateReq(query, options.proto()))
                .map(r -> r.getMatchAggregateRes().getAnswer())
                .map(NumericImpl::of);
    }

    
    public function match(TypeQLMatch.Group query) : Stream<ConceptMapGroup>{
        return matchGroup(query.tostring());
    }

    
    public function match(TypeQLMatch.Group query, TypeDBOptions options) : Stream<ConceptMapGroup>{
        return matchGroup(query.tostring(), options);
    }

    
    public function matchGroup(string query) : Stream<ConceptMapGroup>{
        return matchGroup(query, TypeDBOptions.core());
    }

    
    public function matchGroup(string query, TypeDBOptions options) : Stream<ConceptMapGroup>{
        return stream(matchGroupReq(query, options.proto()))
                .flatMap(rp -> rp.getMatchGroupResPart().getAnswersList().stream())
                .map(ConceptMapGroupImpl::of);
    }

    
    public function match(TypeQLMatch.Group.Aggregate query) : Stream<NumericGroup>{
        return matchGroupAggregate(query.tostring());
    }

    
    public function match(TypeQLMatch.Group.Aggregate query, TypeDBOptions options) : Stream<NumericGroup>{
        return matchGroupAggregate(query.tostring(), options);
    }

    
    public function matchGroupAggregate(string query) : Stream<NumericGroup>{
        return matchGroupAggregate(query, TypeDBOptions.core());
    }

    
    public function matchGroupAggregate(string query, TypeDBOptions options) : Stream<NumericGroup>{
        return stream(matchGroupAggregateReq(query, options.proto()))
                .flatMap(rp -> rp.getMatchGroupAggregateResPart().getAnswersList().stream())
                .map(NumericGroupImpl::of);
    }

    
    public function insert(TypeQLInsert query) : Stream<ConceptMap>{
        return insert(query.tostring());
    }

    
    public function insert(TypeQLInsert query, TypeDBOptions options) : Stream<ConceptMap>{
        return insert(query.tostring(), options);
    }

    
    public function insert(string query) : Stream<ConceptMap>{
        return insert(query, TypeDBOptions.core());
    }

    
    public function insert(string query, TypeDBOptions options) : Stream<ConceptMap>{
        return stream(insertReq(query, options.proto()))
                .flatMap(rp -> rp.getInsertResPart().getAnswersList().stream())
                .map(ConceptMapImpl::of);
    }

    
    public function delete(TypeQLDelete query) : QueryFuture<Void>{
        return delete(query.tostring());
    }

    
    public function delete(TypeQLDelete query, TypeDBOptions options) : QueryFuture<Void>{
        return delete(query.tostring(), options);
    }

    
    public function delete(string query) : QueryFuture<Void>{
        return delete(query, TypeDBOptions.core());
    }

    
    public function delete(string query, TypeDBOptions options) : QueryFuture<Void>{
        return queryVoid(deleteReq(query, options.proto()));
    }

    
    public function update(TypeQLUpdate query) : Stream<ConceptMap>{
        return update(query.tostring());
    }

    
    public function update(TypeQLUpdate query, TypeDBOptions options) : Stream<ConceptMap>{
        return update(query.tostring(), options);
    }

    
    public function update(string query) : Stream<ConceptMap>{
        return update(query, TypeDBOptions.core());
    }

    
    public function update(string query, TypeDBOptions options) : Stream<ConceptMap>{
        return stream(updateReq(query, options.proto()))
                .flatMap(rp -> rp.getUpdateResPart().getAnswersList().stream())
                .map(ConceptMapImpl::of);
    }

    
    public function define(TypeQLDefine query) : QueryFuture<Void>{
        return define(query.tostring());
    }

    
    public function define(TypeQLDefine query, TypeDBOptions options) : QueryFuture<Void>{
        return define(query.tostring(), options);
    }

    
    public function define(string query) : QueryFuture<Void>{
        return define(query, TypeDBOptions.core());
    }

    
    public function define(string query, TypeDBOptions options) : QueryFuture<Void>{
        return queryVoid(defineReq(query, options.proto()));
    }

    
    public function undefine(TypeQLUndefine query) : QueryFuture<Void>{
        return undefine(query.tostring());
    }

    
    public function undefine(TypeQLUndefine query, TypeDBOptions options) : QueryFuture<Void>{
        return define(query.tostring(), options);
    }

    
    public function undefine(string query) : QueryFuture<Void>{
        return undefine(query, TypeDBOptions.core());
    }

    
    public function undefine(string query, TypeDBOptions options) : QueryFuture<Void>{
        return queryVoid(undefineReq(query, options.proto()));
    }

    
    public function explain(ConceptMap.Explainable explainable) : Stream<Explanation>{
        return explain(explainable, TypeDBOptions.core());
    }

    
    public function explain(ConceptMap.Explainable explainable, TypeDBOptions options) : Stream<Explanation>{
        return stream(explainReq(explainable.id(), options.proto()))
                .flatMap(rp -> rp.getExplainResPart().getExplanationsList().stream())
                .map(ExplanationImpl::of);
    }

    private QueryFuture<Void> queryVoid(TransactionProto.Transaction.Req.Builder req) {
        return transactionExt.query(req).map(res -> null);
    }

    private QueryFuture<QueryProto.QueryManager.Res> query(TransactionProto.Transaction.Req.Builder req) {
        return transactionExt.query(req).map(TransactionProto.Transaction.Res::getQueryManagerRes);
    }

    private Stream<QueryProto.QueryManager.ResPart> stream(TransactionProto.Transaction.Req.Builder req) {
        return transactionExt.stream(req).map(TransactionProto.Transaction.ResPart::getQueryManagerResPart);
    }
*/
}
