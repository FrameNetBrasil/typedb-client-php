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
package com.vaticle.typedb.client.connection.core;

import com.vaticle.typedb.client.common.rpc.TypeDBStub;
import com.vaticle.typedb.client.connection.TypeDBClientImpl;
import io.grpc.ManagedChannel;
import io.grpc.netty.NettyChannelBuilder;
*/
namespace TypeDb\Client\Connection\Core;

use TypeDb\Client\Connection\TypeDBClientImpl;
use Typedb\Protocol\TypeDBClient;

class CoreClient extends TypeDBClientImpl {

    private TypeDBClient $stub;

    public function __construct(string $address, int $parallelisation = null) {
        if (is_null($parallelisation)) {
            $parallelisation = $this->calculateParallelisation();
        }
        parent::__construct($parallelisation);
//        $channel = NettyChannelBuilder.forTarget(address).usePlaintext().build();
//        stub = CoreStub.create(channel);
//        validateConnectionOrThrow();
        $this->stub = new TypeDBClient($address, [
            'credentials' => Grpc\ChannelCredentials::createInsecure(),
        ]);
    }


/*
private final ManagedChannel channel;
private final TypeDBStub stub;

public CoreClient(String address) {
    this(address, calculateParallelisation());
}

public CoreClient(String address, int parallelisation) {
    super(parallelisation);
    channel = NettyChannelBuilder.forTarget(address).usePlaintext().build();
    stub = CoreStub.create(channel);
    validateConnectionOrThrow();
}

@Override
public ManagedChannel channel() {
    return channel;
}

@Override
public TypeDBStub stub() {
    return stub;
}
*/
    public function stub(): TypeDbClient {
        return $this->stub;
    }
}
