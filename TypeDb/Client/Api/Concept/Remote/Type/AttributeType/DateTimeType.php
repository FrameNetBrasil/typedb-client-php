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

namespace TypeDb\Client\Api\Concept\Type\AttributeType;

use TypeDb\Client\Api\Concept\Remote\Type\AttributeType;
use TypeDb\Client\Api\Concept\Type\Boolean;
use TypeDb\Client\Api\Concept\Type\AttributeType\BooleanType as BooleanTypeLocal;


interface DateTimeType extends AttributeType, BooleanTypeLocal
{

    public function isDateTime(): bool;

    public function getType(): AttributeType;

    public function asRemote(TypeDBTransaction $transaction): DateTimeTypeRemote;
Attribute.DateTime put(LocalDateTime value);



Attribute.DateTime get(LocalDateTime value);



Stream<? extends Attribute.DateTime> getInstances();



Stream<? extends AttributeType.DateTime> getSubtypes();

void setSupertype(AttributeType.DateTime dateTimeAttributeType);


}