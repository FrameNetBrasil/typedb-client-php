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

namespace TypeDb\Client\Common;

import javax.annotation.Nullable;
import java.util.Objects;
import java.util.Optional;

class Label{

    private  string scope;
    private  string name;
    private  int hash;

    private Label( string scope, string name) {
        this.scope = scope;
        this.name = name;
        this.hash = Objects.hash(name, scope);
    }

    public function Label of(string name) : static{
        return new Label(null, name);
    }

    public function Label of(string scope, string name) : static{
        return new Label(scope, name);
    }

    public function scope() : string | null{
        return Optional.ofNullable(scope);
    }

    public function name() : string{
        return name;
    }

    public function scopedName() : string{
        if (scope == null) return name;
        else return scope + ":" + name;
    }

    
    public function tostring() : string{
        return scopedName();
    }

    
    public function equals(Object o) : bool{
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        Label that = (Label) o;
        return this.name.equals(that.name) && Objects.equals(this.scope, that.scope);
    }

    
    public function hashCode() : int{
        return hash;
    }
}
