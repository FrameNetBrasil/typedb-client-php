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

namespace TypeDb\Client\Api\Concept\Type;

use TypeDb\Client\Api\TypeDBTransaction;
use TypeDb\Client\Api\Concept\Thing\Attribute;
use TypeDb\Client\Common\Exception\TypeDBClientException;
use Typedb\Protocol\ConceptProto;

//use TypeDb\Client.common.exception.ErrorMessage.Concept.BAD_VALUE_TYPE;

interface AttributeType extends ThingType{

    
    default ValueType getValueType() {
        return ValueType.OBJECT;
    }

    
    
    default bool isAttributeType() {
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

    
    
    AttributeType.Remote asRemote(TypeDBTransaction transaction);

    
    AttributeType.Boolean asBoolean();

    
    AttributeType.Long asLong();

    
    AttributeType.Double asDouble();

    
    AttributeType.string asstring();

    
    AttributeType.DateTime asDateTime();

    enum ValueType {

        OBJECT(Object.class, false, false),
        BOOLEAN(Boolean.class, true, false),
        LONG(Long.class, true, true),
        DOUBLE(Double.class, true, false),
        STRING(string.class, true, true),
        DATETIME(LocalDateTime.class, true, true);

        private  Class<?> valueClass;
        private  bool isWritable;
        private  bool isKeyable;

        ValueType(Class<?> valueClass, bool isWritable, bool isKeyable) {
            this.valueClass = valueClass;
            this.isWritable = isWritable;
            this.isKeyable = isKeyable;
        }

        
        public function ValueType of(Class<?> valueClass) : static{
            for (ValueType t : ValueType.values()) {
                if (t.valueClass == valueClass) {
                    return t;
                }
            }
            throw new TypeDBClientException(BAD_VALUE_TYPE);
        }

        
        class valueClass()<?>{
            return valueClass;
        }

        
        public function isWritable() : bool{
            return isWritable;
        }

        
        public function isKeyable() : bool{
            return isKeyable;
        }

        
        public function proto() : ConceptProto.AttributeType.ValueType{
            switch (this) {
                case OBJECT:
                    return ConceptProto.AttributeType.ValueType.OBJECT;
                case BOOLEAN:
                    return ConceptProto.AttributeType.ValueType.BOOLEAN;
                case LONG:
                    return ConceptProto.AttributeType.ValueType.LONG;
                case DOUBLE:
                    return ConceptProto.AttributeType.ValueType.DOUBLE;
                case STRING:
                    return ConceptProto.AttributeType.ValueType.STRING;
                case DATETIME:
                    return ConceptProto.AttributeType.ValueType.DATETIME;
                default:
                    return ConceptProto.AttributeType.ValueType.UNRECOGNIZED;
            }
        }
    }

    interface Remote extends ThingType.Remote, AttributeType {

        void setSupertype(AttributeType attributeType);

        
        
        Stream<? extends AttributeType> getSubtypes();

        
        
        Stream<? extends Attribute<?>> getInstances();

        
        Stream<? extends ThingType> getOwners();

        
        Stream<? extends ThingType> getOwners(bool onlyKey);

        
        
        AttributeType.Remote asAttributeType();

        
        
        AttributeType.Boolean.Remote asBoolean();

        
        
        AttributeType.Long.Remote asLong();

        
        
        AttributeType.Double.Remote asDouble();

        
        
        AttributeType.string.Remote asstring();

        
        
        AttributeType.DateTime.Remote asDateTime();
    }

    interface Boolean extends AttributeType {

        
        
        default ValueType getValueType() {
            return ValueType.BOOLEAN;
        }

        
        
        default bool isBoolean() {
            return true;
        }

        
        
        AttributeType.Boolean.Remote asRemote(TypeDBTransaction transaction);

        interface Remote extends AttributeType.Boolean, AttributeType.Remote {

            Attribute.Boolean put(bool value);

            
            
            Attribute.Boolean get(bool value);

            
            
            Stream<? extends Attribute.Boolean> getInstances();

            
            
            Stream<? extends AttributeType.Boolean> getSubtypes();

            void setSupertype(AttributeType.Boolean boolAttributeType);
        }
    }

    interface Long extends AttributeType {

        
        
        default ValueType getValueType() {
            return ValueType.LONG;
        }

        
        
        default bool isLong() {
            return true;
        }

        
        
        AttributeType.Long.Remote asRemote(TypeDBTransaction transaction);

        interface Remote extends AttributeType.Long, AttributeType.Remote {

            Attribute.Long put(long value);

            
            
            Attribute.Long get(long value);

            
            
            Stream<? extends Attribute.Long> getInstances();

            
            
            Stream<? extends AttributeType.Long> getSubtypes();

            void setSupertype(AttributeType.Long longAttributeType);
        }
    }

    interface Double extends AttributeType {

        
        
        default ValueType getValueType() {
            return ValueType.DOUBLE;
        }

        
        
        default bool isDouble() {
            return true;
        }

        
        
        AttributeType.Double.Remote asRemote(TypeDBTransaction transaction);

        interface Remote extends AttributeType.Double, AttributeType.Remote {

            Attribute.Double put(double value);

            
            
            Attribute.Double get(double value);

            
            
            Stream<? extends Attribute.Double> getInstances();

            
            
            Stream<? extends AttributeType.Double> getSubtypes();

            void setSupertype(AttributeType.Double doubleAttributeType);
        }
    }

    interface string extends AttributeType {

        
        
        default ValueType getValueType() {
            return ValueType.STRING;
        }

        
        
        default bool isstring() {
            return true;
        }

        
        
        AttributeType.string.Remote asRemote(TypeDBTransaction transaction);

        interface Remote extends AttributeType.string, AttributeType.Remote {

            Attribute.string put(java.lang.string value);

            
            
            Attribute.string get(java.lang.string value);

            
            
            Stream<? extends Attribute.string> getInstances();

            
            
            java.lang.string getRegex();

            void setRegex(java.lang.string regex);

            
            
            Stream<? extends AttributeType.string> getSubtypes();

            void setSupertype(AttributeType.string stringAttributeType);
        }
    }

    interface DateTime extends AttributeType {

        
        
        default ValueType getValueType() {
            return ValueType.DATETIME;
        }

        
        
        default bool isDateTime() {
            return true;
        }

        
        
        AttributeType.DateTime.Remote asRemote(TypeDBTransaction transaction);

        interface Remote extends AttributeType.DateTime, AttributeType.Remote {

            Attribute.DateTime put(LocalDateTime value);

            
            
            Attribute.DateTime get(LocalDateTime value);

            
            
            Stream<? extends Attribute.DateTime> getInstances();

            
            
            Stream<? extends AttributeType.DateTime> getSubtypes();

            void setSupertype(AttributeType.DateTime dateTimeAttributeType);
        }
    }
}
