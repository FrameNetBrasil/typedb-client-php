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
namespace TypeDb\Client\Api\Query;

use TypeDb\Client.api.TypeDBOptions;
use TypeDb\Client\Api\Answer.ConceptMap;
use TypeDb\Client\Api\Answer.ConceptMapGroup;
use TypeDb\Client\Api\Answer.Numeric;
use TypeDb\Client\Api\Answer.NumericGroup;
use TypeDb\Client.api.logic.Explanation;
import com.vaticle.typeql.lang.query.TypeQLDefine;
import com.vaticle.typeql.lang.query.TypeQLDelete;
import com.vaticle.typeql.lang.query.TypeQLInsert;
import com.vaticle.typeql.lang.query.TypeQLMatch;
import com.vaticle.typeql.lang.query.TypeQLUndefine;
import com.vaticle.typeql.lang.query.TypeQLUpdate;

import javax.annotation.CheckReturnValue;
import java.util.stream.Stream;

public function QueryManager : interface{

    
    Stream<ConceptMap> match(TypeQLMatch query);

    
    Stream<ConceptMap> match(TypeQLMatch query, TypeDBOptions options);

    
    Stream<ConceptMap> match(string query);

    
    Stream<ConceptMap> match(string query, TypeDBOptions options);

    
    QueryFuture<Numeric> match(TypeQLMatch.Aggregate query);

    
    QueryFuture<Numeric> match(TypeQLMatch.Aggregate query, TypeDBOptions options);

    
    QueryFuture<Numeric> matchAggregate(string query);

    
    QueryFuture<Numeric> matchAggregate(string query, TypeDBOptions options);

    
    Stream<ConceptMapGroup> match(TypeQLMatch.Group query);

    
    Stream<ConceptMapGroup> match(TypeQLMatch.Group query, TypeDBOptions options);

    
    Stream<ConceptMapGroup> matchGroup(string query);

    
    Stream<ConceptMapGroup> matchGroup(string query, TypeDBOptions options);

    
    Stream<NumericGroup> match(TypeQLMatch.Group.Aggregate query);

    
    Stream<NumericGroup> match(TypeQLMatch.Group.Aggregate query, TypeDBOptions options);

    
    Stream<NumericGroup> matchGroupAggregate(string query);

    
    Stream<NumericGroup> matchGroupAggregate(string query, TypeDBOptions options);

    Stream<ConceptMap> insert(TypeQLInsert query);

    Stream<ConceptMap> insert(TypeQLInsert query, TypeDBOptions options);

    Stream<ConceptMap> insert(string query);

    Stream<ConceptMap> insert(string query, TypeDBOptions options);

    QueryFuture<Void> delete(TypeQLDelete query);

    QueryFuture<Void> delete(TypeQLDelete query, TypeDBOptions options);

    QueryFuture<Void> delete(string query);

    QueryFuture<Void> delete(string query, TypeDBOptions options);

    Stream<ConceptMap> update(TypeQLUpdate query);

    Stream<ConceptMap> update(TypeQLUpdate query, TypeDBOptions options);

    Stream<ConceptMap> update(string query);

    Stream<ConceptMap> update(string query, TypeDBOptions options);

    QueryFuture<Void> define(TypeQLDefine query);

    QueryFuture<Void> define(TypeQLDefine query, TypeDBOptions options);

    QueryFuture<Void> define(string query);

    QueryFuture<Void> define(string query, TypeDBOptions options);

    QueryFuture<Void> undefine(TypeQLUndefine query);

    QueryFuture<Void> undefine(TypeQLUndefine query, TypeDBOptions options);

    QueryFuture<Void> undefine(string query);

    QueryFuture<Void> undefine(string query, TypeDBOptions options);

    
    Stream<Explanation> explain(ConceptMap.Explainable explainable);

    
    Stream<Explanation> explain(ConceptMap.Explainable explainable, TypeDBOptions options);
}
*/
