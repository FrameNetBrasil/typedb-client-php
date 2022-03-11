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

namespace TypeDb\Client\Api\Concept\Remote;

use TypeDb\Client\Api\Concept\Concept as ConceptLocal;
use TypeDb\Client\Api\Concept\Remote\Thing\Attribute;
use TypeDb\Client\Api\Concept\Remote\Thing\Entity;
use TypeDb\Client\Api\Concept\Remote\Thing\Relation;
use TypeDb\Client\Api\Concept\Remote\Thing\Thing;
use TypeDb\Client\Api\Concept\Remote\Type\AttributeType;
use TypeDb\Client\Api\Concept\Remote\Type\EntityType;
use TypeDb\Client\Api\Concept\Remote\Type\RelationType;
use TypeDb\Client\Api\Concept\Remote\Type\RoleType;
use TypeDb\Client\Api\Concept\Remote\Type\ThingType;
use TypeDb\Client\Api\Concept\Remote\Type\Type;

interface Concept extends ConceptLocal
{

    public function delete(): void;

    public function isDeleted(): bool;

    public function asType(): Type;

    public function asThingType(): ThingType;

    public function asEntityType(): EntityType;

    public function asRelationType(): RelationType;

    public function asAttributeType(): AttributeType;

    public function asRoleType(): RoleType;

    public function asThing(): Thing;

    public function asEntity(): Entity;

    public function asRelation(): Relation;

    public function asAttribute(): Attribute;
}

