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

import javax.annotation.Nullable;
import java.nio.file.Path;
import java.util.Optional;

class TypeDBCredential{

    private  string username;
    private  string password;
    private  bool tlsEnabled;
    
    private  Path tlsRootCA;

    public function username, string password, bool tlsEnabled) : TypeDBCredential(string{
        this(username, password, tlsEnabled, null);
    }

    public function username, string password, Path tlsRootCA) : TypeDBCredential(string{
        this(username, password, true, tlsRootCA);
    }

    private TypeDBCredential(string username, string password, bool tlsEnabled,  Path tlsRootCA) {
        this.username = username;
        this.password = password;
        this.tlsEnabled = tlsEnabled;
        this.tlsRootCA = tlsRootCA;
        assert tlsEnabled || tlsRootCA == null;
    }

    public function username() : string{
        return username;
    }

    public function password() : string{
        return password;
    }

    public function tlsEnabled() : bool{
        return tlsEnabled;
    }

    public function tlsRootCA() : Path | null{
        return Optional.ofNullable(tlsRootCA);
    }
}
