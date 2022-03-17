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

import com.vaticle.typedb.client.api.database.Database;
import com.vaticle.typedb.client.common.rpc.TypeDBStub;

import static com.vaticle.typedb.client.common.rpc.RequestBuilder.Core.Database.deleteReq;
import static com.vaticle.typedb.client.common.rpc.RequestBuilder.Core.Database.schemaReq;
import static com.vaticle.typedb.client.connection.TypeDBDatabaseManagerImpl.nonNull;
*/

namespace TypeDb\Client\Connection;

use TypeDb\Client\Api\Database\Database;
use TypeDb\Client\Common\RPC\TypeDBStub;

class TypeDBDatabaseImpl implements Database
{

    private string $name;
    private TypeDBDatabaseManagerImpl $databaseMgr;

    public function __construct(TypeDBDatabaseManagerImpl $databaseMgr, string $name)
    {
        $this->databaseMgr = $databaseMgr;
        $this->name = $this->nonNull(($name));
    }

    private function stub(): TypeDBStub
    {
        return $this->databaseMgr->stub();
    }

    public function name(): string
    {
        return $this->name;
    }

    public function schema(): string
    {
        return $this->stub()->databaseSchema(schemaReq(name)) . getSchema();
    }

    public function delete(): void
    {
        $this->stub()->databaseDelete(deleteReq(name));
    }

    public function toString(): string
    {
        return $this->name;
    }

    /*
    private final String name;
    private final TypeDBDatabaseManagerImpl databaseMgr;

    public TypeDBDatabaseImpl(TypeDBDatabaseManagerImpl databaseMgr, String name) {
        this.databaseMgr = databaseMgr;
        this.name = nonNull((name));
    }

    private TypeDBStub stub() {
        return databaseMgr.stub();
    }

    @Override
    public String name() {
        return name;
    }

    @Override
    public String schema() {
        return stub().databaseSchema(schemaReq(name)).getSchema();
    }

    @Override
    public void delete() {
        stub().databaseDelete(deleteReq(name));
    }

    @Override
    public String toString() {
        return name;
    }
    */
}
