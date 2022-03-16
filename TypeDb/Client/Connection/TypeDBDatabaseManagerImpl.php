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
import com.vaticle.typedb.client.api.database.DatabaseManager;
import com.vaticle.typedb.client.common.exception.TypeDBClientException;
import com.vaticle.typedb.client.common.rpc.TypeDBStub;

import java.util.List;

import static com.vaticle.typedb.client.common.exception.ErrorMessage.Client.DB_DOES_NOT_EXIST;
import static com.vaticle.typedb.client.common.exception.ErrorMessage.Client.MISSING_DB_NAME;
import static com.vaticle.typedb.client.common.rpc.RequestBuilder.Core.DatabaseManager.allReq;
import static com.vaticle.typedb.client.common.rpc.RequestBuilder.Core.DatabaseManager.containsReq;
import static com.vaticle.typedb.client.common.rpc.RequestBuilder.Core.DatabaseManager.createReq;
import static java.util.stream.Collectors.toList;
*/

namespace TypeDb\Client\Connection;

use TypeDb\Client\Api\Database\DatabaseManager;
use TypeDb\Client\Api\Database\Database;
use TypeDb\Client\Common\Exception\ErrorMessage;
use TypeDb\Client\Common\Exception\TypeDBClientException;
use TypeDb\Client\Common\RPC\RequestBuilder\Core\DatabaseManager as RBDatabaseManager;
use Typedb\Protocol\TypeDBClient;

class TypeDBDatabaseManagerImpl implements DatabaseManager {

    private TypeDBClientImpl $client;

    public function __construct(TypeDBClientImpl $client) {
        $this->client = $client;
    }

    public function get(string $name): Database {
        if ($this->contains($name)) {
            return new TypeDBDatabaseImpl($this, $name);
        }
        else throw new TypeDBClientException(ErrorMessage::DB_DOES_NOT_EXIST($name));
    }

    public function contains(string $name):bool {
        return $this->stub()->databases_contains(RBDatabaseManager::containsReq($this->nonNull($name)))->getContains();
    }

    public function create(string $name): void {
        //$this->client->databasesCreate(createReq(nonNull(name)));
    }

    public function all(): array {
        //$databases = $this->client->databasesAll(allReq()).getNamesList();
        //return $databases->stream()->map(name -> new TypeDBDatabaseImpl(this, name)).collect(toList());
    }

    publoic function stub(): TypeDbClient {
        return $this->client->stub();
    }

    static private function nonNull(string $name) {
        if (is_null($name)) {
            throw new TypeDBClientException(ErrorMessage::MISSING_DB_NAME());
        }
        return $name;
    }
}
