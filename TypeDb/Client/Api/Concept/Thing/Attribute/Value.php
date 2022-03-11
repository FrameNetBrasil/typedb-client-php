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

use TypeDb\Client.api.TypeDBTransaction;
use TypeDb\Client.api.concept.type.AttributeType;
use TypeDb\Client.api.concept.type.ThingType;

import javax.annotation.CheckReturnValue;
import java.time.LocalDateTime;
import java.util.stream.Stream;

interface Attribute extends Thing {

    
    
    AttributeType getType();

    
    VALUE getValue();

    
    
    default bool isAttribute() {
        return true;
    }

    
    default bool isBoolean() {
        return false;
    }

    
    default bool isLong() {
        return false;
    }

    
    default bool isDouble() {
        return false;
    }

    
    default bool isstring() {
        return false;
    }

    
    default bool isDateTime() {
        return false;
    }

    
    Attribute.Boolean asBoolean();

    
    Attribute.Long asLong();

    
    Attribute.Double asDouble();

    
    Attribute.string asstring();

    
    Attribute.DateTime asDateTime();

    
    
    Attribute.Remote<VALUE> asRemote(TypeDBTransaction transaction);

    interface Remote<VALUE> extends Thing.Remote, Attribute<VALUE> {

        
        Stream<? extends Thing> getOwners();

        
        Stream<? extends Thing> getOwners(ThingType ownerType);

        
        
        Attribute.Remote<VALUE> asAttribute();

        
        
        Attribute.Boolean.Remote asBoolean();

        
        
        Attribute.Long.Remote asLong();

        
        
        Attribute.Double.Remote asDouble();

        
        
        Attribute.string.Remote asstring();

        
        
        Attribute.DateTime.Remote asDateTime();
    }

    interface Boolean extends Attribute<java.lang.Boolean> {

        
        
        default bool isBoolean() {
            return true;
        }

        
        
        AttributeType.Boolean getType();

        
        
        Attribute.Boolean.Remote asRemote(TypeDBTransaction transaction);

        interface Remote extends Attribute.Boolean, Attribute.Remote<java.lang.Boolean> {
        }
    }

    interface Long extends Attribute<java.lang.Long> {

        
        
        default bool isLong() {
            return true;
        }

        
        
        AttributeType.Long getType();

        
        
        Attribute.Long.Remote asRemote(TypeDBTransaction transaction);

        interface Remote extends Attribute.Long, Attribute.Remote<java.lang.Long> {
        }
    }

    interface Double extends Attribute<java.lang.Double> {

        
        
        default bool isDouble() {
            return true;
        }

        
        
        AttributeType.Double getType();

        
        
        Attribute.Double.Remote asRemote(TypeDBTransaction transaction);

        interface Remote extends Attribute.Double, Attribute.Remote<java.lang.Double> {
        }
    }

    interface string extends Attribute<java.lang.string> {

        
        
        default bool isstring() {
            return true;
        }

        
        
        AttributeType.string getType();

        
        
        Attribute.string.Remote asRemote(TypeDBTransaction transaction);

        interface Remote extends Attribute.string, Attribute.Remote<java.lang.string> {
        }
    }

    interface DateTime extends Attribute<LocalDateTime> {

        
        
        default bool isDateTime() {
            return true;
        }

        
        
        AttributeType.DateTime getType();

        
        
        Attribute.DateTime.Remote asRemote(TypeDBTransaction transaction);

        interface Remote extends Attribute.DateTime, Attribute.Remote<LocalDateTime> {
        }
    }
}
