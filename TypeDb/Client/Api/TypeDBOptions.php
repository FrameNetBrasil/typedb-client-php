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

namespace TypeDb\Client\Api;

use Exception;

class TypeDBOptions {

    private ?bool $infer = null;
    private ?bool $traceInference = null;
    private ?bool $explain = null;
    private ?bool $parallel = null;
    private ?bool $prefetch = null;
    private ?int $prefetchSize = null;
    private ?int $sessionIdleTimeoutMillis = null;
    private ?int $transactionTimeoutMillis = null;
    private ?int $schemaLockAcquireTimeoutMillis = null;

    public static function  core(): TypeDBOptions  {
        return new TypeDBOptions();
    }

    public static function cluster(): TypeDBOptionsCluster {
        return new TypeDBOptionsCluster();
    }

    public function isCluster(): bool {
        return false;
    }

    public function infer(?bool $infer): bool|TypeDBOptions {
        if (isset($infer)) {
            $this->infer = $infer;
            return $this;
        }
        return $infer;
    }

    public function traceInference(?bool $traceInference): bool|TypeDBOptions {
        if (isset($traceInference)) {
            $this->traceInference = $traceInference;
            return $this;
        }
        return $traceInference;
    }

    public function explain(?bool $explain): bool|TypeDBOptions {
        if (isset($explain)) {
            $this->explain = $explain;
            return $this;
        }
        return $explain;
    }

    public function parallel(?bool $parallel): bool|TypeDBOptions {
        if (isset($parallel)) {
            $this->parallel = $parallel;
            return $this;
        }
        return $parallel;
    }

    public function prefetch(?bool $prefetch): bool|TypeDBOptions {
        if (isset($prefetch)) {
            $this->prefetch = $prefetch;
            return $this;
        }
        return $prefetch;
    }

    public function prefetchSize(?int $prefetchSize): int|TypeDBOptions {
        if (isset($prefetchSize)) {
            if ($prefetchSize < 1) {
                //throw new TypeDBClientException(NEGATIVE_VALUE_NOT_ALLOWED, prefetchSize);
            }
            $this->prefetchSize = $prefetchSize;
            return $this;
        }
        return $prefetchSize;
    }

    public function sessionIdleTimeoutMillis(?int $sessionIdleTimeoutMillis): int|TypeDBOptions {
        if (isset($sessionIdleTimeoutMillis)) {
            if ($sessionIdleTimeoutMillis < 1) {
                //throw new TypeDBClientException(NEGATIVE_VALUE_NOT_ALLOWED, prefetchSize);
            }
            $this->sessionIdleTimeoutMillis = $sessionIdleTimeoutMillis;
            return $this;
        }
        return $sessionIdleTimeoutMillis;
    }

    public function schemaLockAcquireTimeoutMillis(?int $schemaLockAcquireTimeoutMillis): int|TypeDBOptions {
        if (isset($schemaLockAcquireTimeoutMillis)) {
            if ($schemaLockAcquireTimeoutMillis < 1) {
                //throw new TypeDBClientException(NEGATIVE_VALUE_NOT_ALLOWED, prefetchSize);
            }
            $this->schemaLockAcquireTimeoutMillis = $schemaLockAcquireTimeoutMillis;
            return $this;
        }
        return $schemaLockAcquireTimeoutMillis;
    }

    public function transactionTimeoutMillis(?int $transactionTimeoutMillis): int|TypeDBOptions {
        if (isset($transactionTimeoutMillis)) {
            if ($transactionTimeoutMillis < 1) {
                //throw new TypeDBClientException(NEGATIVE_VALUE_NOT_ALLOWED, prefetchSize);
            }
            $this->transactionTimeoutMillis = $transactionTimeoutMillis;
            return $this;
        }
        return $transactionTimeoutMillis;
    }


    /**
     * @throws Exception
     */
    public function asCluster() {
        //throw new TypeDBClientException(ILLEGAL_CAST, className(Cluster.class));
        throw new Exception();
    }
    /*

    public function OptionsProto.Options proto() {
OptionsProto.Options.Builder builder = OptionsProto.Options.newBuilder();
        infer().ifPresent(builder::setInfer);
        traceInference().ifPresent(builder::setTraceInference);
        explain().ifPresent(builder::setExplain);
        parallel().ifPresent(builder::setParallel);
        prefetchSize().ifPresent(builder::setPrefetchSize);
        prefetch().ifPresent(builder::setPrefetch);
        sessionIdleTimeoutMillis().ifPresent(builder::setSessionIdleTimeoutMillis);
        transactionTimeoutMillis().ifPresent(builder::setTransactionTimeoutMillis);
        schemaLockAcquireTimeoutMillis().ifPresent(builder::setSchemaLockAcquireTimeoutMillis);
        if (isCluster()) asCluster().readAnyReplica().ifPresent(builder::setReadAnyReplica);

        return builder.build();
    }
    */

}
