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
use TypeDb\Client\Api\TypeDBTransaction;
use TypeDb\Client\Api\Concept\Thing\Attribute;
use TypeDb\Client\Api\Concept\Thing\Entity;
use TypeDb\Client\Api\Concept\Thing\Relation;
use TypeDb\Client\Api\Concept\Remote\Thing\Thing as ThingRemote;
use TypeDb\Client\Api\Concept\Type\AttributeType;
use TypeDb\Client\Api\Concept\Type\EntityType;
use TypeDb\Client\Api\Concept\Type\RelationType;
use TypeDb\Client\Api\Concept\Type\RoleType;
use TypeDb\Client\Api\Concept\Type\ThingType;
use TypeDb\Client\Api\Concept\Type\Type;

interface Concept
{


    public function isType(): bool;


    public function isThingType(): bool;

    public function isEntityType(): bool;


    public function isAttributeType(): bool;

    public function isRelationType(): bool;

    public function isRoleType(): bool;

    public function isThing(): bool;

    public function isEntity(): bool;

    public function isAttribute(): bool;

    public function isRelation(): bool;

    public function asType(): Type;


    public function asThingType(): ThingType;


    public function asEntityType(): EntityType;


    public function asAttributeType(): AttributeType;


    public function asRelationType(): RelationType;


    public function asRoleType(): RoleType;


    public function asThing(): Thing;


    public function asEntity(): Entity;


    public function asAttribute(): Attribute;


    public function asRelation(): Relation;


    public function asRemote(TypeDBTransaction $transaction): ThingRemote;


    public function isRemote(): bool;

}
