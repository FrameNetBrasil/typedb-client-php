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

namespace TypeDb\Client\Api\Concept\Thing;

use TypeDb\Client\Api\TypeDBTransaction;
use TypeDb\Client\Api\Concept\Type\AttributeType;
use TypeDb\Client\Api\Concept\Type\ThingType;

interface Attribute extends Thing {

    AttributeType public function getType();

    
    VALUE public function getValue();

    
    
    default bool public function isAttribute() {
        return true;
    }

    
    default bool public function isBoolean() {
        return false;
    }

    
    default bool public function isLong() {
        return false;
    }

    
    default bool public function isDouble() {
        return false;
    }

    
    default bool public function isstring() {
        return false;
    }

    
    default bool public function isDateTime() {
        return false;
    }

    
    Attribute.Boolean public function asBoolean();

    
    Attribute.Long public function asLong();

    
    Attribute.Double public function asDouble();

    
    Attribute.string public function asstring();

    
    Attribute.DateTime public function asDateTime();

    
    
    Attribute.Remote<VALUE> public function asRemote(TypeDBTransaction transaction);











}
