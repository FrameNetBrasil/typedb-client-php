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

use TypeDb\Client.common.exception.TypeDBClientException;
use Typedb\Protocol\OptionsProto;

import javax.annotation.CheckReturnValue;
import java.util.Optional;

use TypeDb\Client.common.exception.ErrorMessage.Client.NEGATIVE_VALUE_NOT_ALLOWED;
use TypeDb\Client.common.exception.ErrorMessage.Internal.ILLEGAL_CAST;
use TypeDb\common.util.Objects.className;

class TypeDBOptions{

    private Boolean infer = null;
    private Boolean traceInference = null;
    private Boolean explain = null;
    private Boolean parallel = null;
    private Boolean prefetch = null;
    private int prefetchSize = null;
    private int sessionIdleTimeoutMillis = null;
    private int transactionTimeoutMillis = null;
    private int schemaLockAcquireTimeoutMillis = null;

    private TypeDBOptions() {
    }

    
    public function TypeDBOptions core() : static{
        return new TypeDBOptions();
    }

    
    public function TypeDBOptions.Cluster cluster() : static{
        return new Cluster();
    }

    
    public function isCluster() : bool{
        return false;
    }

    
    public function infer() : Boolean | null{
        return Optional.ofNullable(infer);
    }

    public function infer(bool infer) : TypeDBOptions{
        this.infer = infer;
        return this;
    }

    
    public function traceInference() : Boolean | null{
        return Optional.ofNullable(traceInference);
    }

    public function traceInference(bool traceInference) : TypeDBOptions{
        this.traceInference = traceInference;
        return this;
    }

    
    public function explain() : Boolean | null{
        return Optional.ofNullable(explain);
    }

    public function explain(bool explain) : TypeDBOptions{
        this.explain = explain;
        return this;
    }

    
    public function parallel() : Boolean | null{
        return Optional.ofNullable(parallel);
    }

    public function parallel(bool parallel) : TypeDBOptions{
        this.parallel = parallel;
        return this;
    }

    
    public function prefetch() : Boolean | null{
        return Optional.ofNullable(prefetch);
    }

    public function prefetch(bool prefetch) : TypeDBOptions{
        this.prefetch = prefetch;
        return this;
    }

    
    public function prefetchSize() : int | null{
        return Optional.ofNullable(prefetchSize);
    }

    public function prefetchSize(int prefetchSize) : TypeDBOptions{
        if (prefetchSize < 1) {
            throw new TypeDBClientException(NEGATIVE_VALUE_NOT_ALLOWED, prefetchSize);
        }
        this.prefetchSize = prefetchSize;
        return this;
    }

    
    public function sessionIdleTimeoutMillis() : int | null{
        return Optional.ofNullable(sessionIdleTimeoutMillis);
    }

    public function sessionIdleTimeoutMillis(int sessionIdleTimeoutMillis) : TypeDBOptions{
        if (sessionIdleTimeoutMillis < 1) {
            throw new TypeDBClientException(NEGATIVE_VALUE_NOT_ALLOWED, sessionIdleTimeoutMillis);
        }
        this.sessionIdleTimeoutMillis = sessionIdleTimeoutMillis;
        return this;
    }

    
    public function schemaLockAcquireTimeoutMillis() : int | null{
        return Optional.ofNullable(schemaLockAcquireTimeoutMillis);
    }

    public function transactionTimeoutMillis(int transactionTimeoutMillis) : TypeDBOptions{
        if (transactionTimeoutMillis < 1) {
            throw new TypeDBClientException(NEGATIVE_VALUE_NOT_ALLOWED, transactionTimeoutMillis);
        }
        this.transactionTimeoutMillis = transactionTimeoutMillis;
        return this;
    }

    public function transactionTimeoutMillis() : int | null{
        return Optional.ofNullable(transactionTimeoutMillis);
    }

    public function schemaLockAcquireTimeoutMillis(int schemaLockAcquireTimeoutMillis) : TypeDBOptions{
        if (schemaLockAcquireTimeoutMillis < 1) {
            throw new TypeDBClientException(NEGATIVE_VALUE_NOT_ALLOWED, schemaLockAcquireTimeoutMillis);
        }
        this.schemaLockAcquireTimeoutMillis = schemaLockAcquireTimeoutMillis;
        return this;
    }

    
    public function asCluster() : Cluster{
        throw new TypeDBClientException(ILLEGAL_CAST, className(Cluster.class));
    }

    
    public function proto() : OptionsProto.Options{
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

    public function class Cluster extends TypeDBOptions : static{

        private Boolean readAnyReplica = null;

        
        public function readAnyReplica() : Boolean | null{
            return Optional.ofNullable(readAnyReplica);
        }

        public function readAnyReplica(bool readAnyReplica) : Cluster{
            this.readAnyReplica = readAnyReplica;
            return this;
        }

        
        
        public function isCluster() : bool{
            return true;
        }

        
        
        public function asCluster() : Cluster{
            return this;
        }
    }
}
