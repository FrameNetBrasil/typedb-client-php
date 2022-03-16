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

namespace TypeDb\Client\Api\Query;

use TypeDb\Client\Api\TypeDBOptions;
use TypeDb\Client\Api\Answer\ConceptMap;
use TypeDb\Client\Api\Answer\ConceptMapGroup;
use TypeDb\Client\Api\Answer\Numeric;
use TypeDb\Client\Api\Answer\NumericGroup;
use TypeDb\Client\Api\Logic\Explanation;
use Typedb\Protocol\Explainable;

//import com.vaticle.typeql.lang.query.TypeQLDefine;
//import com.vaticle.typeql.lang.query.TypeQLDelete;
//import com.vaticle.typeql.lang.query.TypeQLInsert;
//import com.vaticle.typeql.lang.query.TypeQLMatch;
//import com.vaticle.typeql.lang.query.TypeQLUndefine;
//import com.vaticle.typeql.lang.query.TypeQLUpdate;
//
//import javax.annotation.CheckReturnValue;
//import java.util.stream.Stream;

interface QueryManager {

    
    public function match(string $query, ?TypeDBOptions $options);// stream

    
//    public function Stream<ConceptMap> match(string $query, TypeDBOptions $options);

    
//    public function Stream<ConceptMap> match(string $query);

    
//    public function Stream<ConceptMap> match(string $query, TypeDBOptions $options);

    
//    public function QueryFuture<Numeric> match(string $query);

    
//    public function QueryFuture<Numeric> match(string $query, TypeDBOptions $options);

    
//    public function QueryFuture<Numeric> matchAggregate(string $query);

    
    public function matchAggregate(string $query, ?TypeDBOptions $options); //stream

    
//    public function Stream<ConceptMapGroup> match(string $query);

    
//    public function Stream<ConceptMapGroup> match(string $query, TypeDBOptions $options);

    
//    public function Stream<ConceptMapGroup> matchGroup(string $query);

    
    public function matchGroup(string $query, ?TypeDBOptions $options);

    
//    public function Stream<NumericGroup> match(string $query);

    
//    public function Stream<NumericGroup> match(string $query, TypeDBOptions $options);

    
//    public function Stream<NumericGroup> matchGroupAggregate(string $query);

    
    public function matchGroupAggregate(string $query, ?TypeDBOptions $options);

//    public function Stream<ConceptMap> insert(string $query);

//    public function Stream<ConceptMap> insert(string $query, TypeDBOptions $options);

//    public function Stream<ConceptMap> insert(string $query);

    public function insert(string $query, ?TypeDBOptions $options); //stream

//    public function QueryFuture<Void> delete(string $query);

//    public function QueryFuture<Void> delete(string $query, TypeDBOptions $options);

//    public function QueryFuture<Void> delete(string $query);

    public function delete(string $query, ?TypeDBOptions $options);

//    public function Stream<ConceptMap> update(string $query);

//    public function Stream<ConceptMap> update(string $query, TypeDBOptions $options);

//    public function Stream<ConceptMap> update(string $query);

    public function update(string $query, ?TypeDBOptions $options); //stream

//    public function QueryFuture<Void> define(string $query);

//    public function QueryFuture<Void> define(string $query, TypeDBOptions $options);

//    public function QueryFuture<Void> define(string $query);

    public function define(string $query, ?TypeDBOptions $options); //stream

//    public function QueryFuture<Void> undefine(string $query);

//    public function QueryFuture<Void> undefine(string $query, TypeDBOptions $options);

//    public function QueryFuture<Void> undefine(string $query);

    public function undefine(string $query, ?TypeDBOptions $options); //stream

//    public function explain(Explainable $explainable); //stream

    public function explain(Explainable $explainable, ?TypeDBOptions $options);
}
