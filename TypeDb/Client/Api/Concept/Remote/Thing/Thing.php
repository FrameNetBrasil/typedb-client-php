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

namespace TypeDb\Client\Api\Concept\Remote\Thing;

use TypeDb\Client\Api\Concept\Remote\Concept;
use TypeDb\Client\Api\Concept\Type\AttributeType;
use TypeDb\Client\Api\Concept\Type\RoleType;
use TypeDb\Client\Api\Concept\Thing\Thing as ThingLocal;

interface Thing extends Concept, ThingLocal
{


    public function setHas(Attribute $attribute): void;

    public function unsetHas(Attribute $attribute): void;

    public function getHas(bool|AttributeType $param); //stream

    /*
    public function getHas(bool $onlyKey); //stream


    Stream<? extends Attribute.BooleanType> getHas(AttributeType.BooleanType attributeType);


Stream<? extends Attribute.Long> getHas(AttributeType.Long attributeType);


Stream<? extends Attribute.Double> getHas(AttributeType.Double attributeType);


Stream<? extends Attribute.string> getHas(AttributeType.string attributeType);


Stream<? extends Attribute.DateTime> getHas(AttributeType.DateTime attributeType);


Stream<? extends Attribute<?>> getHas(AttributeType... attributeTypes);
*/

    public function getRelations(RoleType $roleTypes);


    public function getPlaying(): RoleType;
}
