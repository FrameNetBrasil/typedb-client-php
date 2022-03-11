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

namespace TypeDb\Client\Api\Concept;

use TypeDb\Client\Api\Concept\Thing\Thing;
use TypeDb\Client\Api\Concept\Type\AttributeType;
use TypeDb\Client\Api\Concept\Type\EntityType;
use TypeDb\Client\Api\Concept\Type\RelationType;
use TypeDb\Client\Api\Concept\Type\ThingType;
use TypeDb\Client\Api\Concept\Type\ValueType;

interface ConceptManager
{

    public function getRootThingType(): ThingType;

    public function getRootEntityType(): EntityType;

    public function getRootRelationType(): RelationType;

    public function getRootAttributeType(): AttributeType;

    public function getThingType(string $label): ThingType;

    public function getThing(string $iid): Thing;

    public function getEntityType(string $label): EntityType;

    public function putEntityType(string $label): EntityType;

    public function getRelationType(string $label): RelationType;

    public function putRelationType(string $label): RelationType;

    public function getAttributeType(string $label): AttributeType;

    public function putAttributeType(string $label, ValueType $valueType): AttributeType;
}
