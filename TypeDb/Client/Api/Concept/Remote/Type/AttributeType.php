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

use TypeDb\Client\Api\Concept\Remote\Type\AttributeType\BooleanType;
use TypeDb\Client\Api\Concept\Remote\Type\AttributeType\DateTimeType;
use TypeDb\Client\Api\Concept\Remote\Type\AttributeType\DoubleType;
use TypeDb\Client\Api\Concept\Remote\Type\AttributeType\LongType;
use TypeDb\Client\Api\Concept\Remote\Type\AttributeType\TStringType;

use TypeDb\Client\Api\Concept\Type\AttributeType as AttributeTypeLocal;


interface AttributeType extends AttributeTypeLocal, ThingType
{

    public function setSupertype(AttributeTypeLocal $attributeType): void;

    public function getSubtypes(); //stream

    public function getInstances(); //stream

    public function getOwners(?bool $onlyKey); //stream

    public function asAttributeType(): AttributeType;

    public function asBoolean(): BooleanType;

    public function asLong(): LongType;

    public function asDouble(): DoubleType;

    public function asString(): TStringType;

    public function asDateTime(): DateTimeType;

}
