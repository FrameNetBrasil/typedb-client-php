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

namespace TypeDb\Client\Api\Concept\Remote\Type;

use TypeDb\Client\Api\Concept\Remote\Concept;
use TypeDb\Client\Api\Concept\Type\AttributeType;
use TypeDb\Client\Api\Concept\Type\RoleType;
use TypeDb\Client\Api\Concept\Type\ThingType as ThingTypeLocal;

interface ThingType extends ThingTypeLocal, Concept
{

    public function getSupertype(): ThingType;

    public function getSupertypes(); //stream

    public function getSubtypes(); //stream;

    public function getInstances(); //stream

    public function setAbstract(): void;

    public function unsetAbstract(): void;

    //public function setPlays(RoleType $roleType): void;

    public function setPlays(RoleType $roleType, ?RoleType $overriddenType = null);

    public function setOwns(AttributeType $attributeType, ?AttributeType $overriddenType = null, bool $isKey = false);

//public function         void setOwns(AttributeType attributeType, AttributeType overriddenType);

//public function         void setOwns(AttributeType attributeType, bool isKey);

//        public function void setOwns(AttributeType attributeType);


    public function getPlays(); // stream

//    public function getOwns(); // stream

    public function getOwns(?ValueType $valueType = null); // stream

    // public function getOwns(bool keysOnly);

    // public function Stream<? extends AttributeType> getOwns(ValueType valueType, bool keysOnly);

    public function unsetPlays(RoleType $roleType): void;

    public function unsetOwns(AttributeType $attributeType): void;
}
