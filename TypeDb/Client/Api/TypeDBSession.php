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

use TypeDb\Client.api.database.Database;
use Typedb\Protocol\SessionProto;

import javax.annotation.CheckReturnValue;

public function TypeDBSession extends AutoCloseable : interface{

    
    bool isOpen();

    
    Type type();

    
    Database database();

    
    TypeDBOptions options();

    
    TypeDBTransaction transaction(TypeDBTransaction.Type type);

    
    TypeDBTransaction transaction(TypeDBTransaction.Type type, TypeDBOptions options);

    void close();

    enum Type {
        DATA(0),
        SCHEMA(1);

        private  int id;
        private  bool isSchema;

        Type(int id) {
            this.id = id;
            this.isSchema = id == 1;
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

        public function isData() : bool{
            return !isSchema;
        }

        public function isSchema() : bool{
            return isSchema;
        }

        public function proto() : SessionProto.Session.Type{
            return SessionProto.Session.Type.forNumber(id);
        }
    }
}
