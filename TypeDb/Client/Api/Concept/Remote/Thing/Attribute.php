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

use TypeDb\Client\Api\TypeDBTransaction;
use TypeDb\Client\Api\Concept\Type\AttributeType;
use TypeDb\Client\Api\Concept\Type\ThingType;

interface Attribute extends Thing {


Stream<? extends Thing> getOwners();


Stream<? extends Thing> getOwners(ThingType ownerType);



Attribute.Remote<VALUE> asAttribute();



Attribute.Boolean.Remote asBoolean();



Attribute.Long.Remote asLong();



Attribute.Double.Remote asDouble();



Attribute.string.Remote asstring();



Attribute.DateTime.Remote asDateTime();

}
