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

namespace TypeDb\client\Api;

use TypeDb\Client\Api\Concept\ConceptManager;
use TypeDb\Client\Api\Logic\LogicManager;
use TypeDb\Client\Api\Query\QueryFuture;
use TypeDb\Client\Api\Query\QueryManager;
use Typedb\Protocol\TransactionProto;

interface TypeDBTransaction {

    
    bool isOpen();

    
    Type type();

    
    TypeDBOptions options();

    
    ConceptManager concepts();

    
    LogicManager logic();

    
    QueryManager query();

    void commit();

    void rollback();

    void close();

    enum Type {
        READ(0),
        WRITE(1);

        private  int id;
        private  bool isWrite;

        Type(int id) {
            this.id = id;
            this.isWrite = id == 1;
        }

        public function Type of(int value) : static{
            for (Type t : values()) {
                if (t.id == value) return t;
            }
            return null;
        }

        public function id() : int{
            return id;
        }

        public function isRead() : bool{
            return !isWrite;
        }

        public function isWrite() : bool{
            return isWrite;
        }

        public function proto() : TransactionProto.Transaction.Type{
            return TransactionProto.Transaction.Type.forNumber(id);
        }
    }

    interface Extended extends TypeDBTransaction {

        TransactionProto.Transaction.Res execute(TransactionProto.Transaction.Req.Builder request);

        QueryFuture<TransactionProto.Transaction.Res> query(TransactionProto.Transaction.Req.Builder request);

        Stream<TransactionProto.Transaction.ResPart> stream(TransactionProto.Transaction.Req.Builder request);
    }
}
