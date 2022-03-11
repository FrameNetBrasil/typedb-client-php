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

namespace TypeDb\Client\Concept\Thing;

use TypeDb\Client.api.TypeDBTransaction;
use TypeDb\Client.api.concept.thing.Attribute;
use TypeDb\Client.api.concept.type.ThingType;
use TypeDb\Client.common.exception.TypeDBClientException;
use TypeDb\Client.concept.type.AttributeTypeImpl;
use Typedb\Protocol\ConceptProto;

import java.time.Instant;
import java.time.LocalDateTime;
import java.time.ZoneOffset;
import java.util.stream.Stream;

use TypeDb\Client.common.exception.ErrorMessage.Concept.BAD_VALUE_TYPE;
use TypeDb\Client.common.exception.ErrorMessage.Concept.INVALID_CONCEPT_CASTING;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.Attribute.getOwnersReq;
use TypeDb\Client.concept.type.ThingTypeImpl.protoThingType;
use TypeDb\common.collection.Bytes.bytesToHexstring;
use TypeDb\common.util.Objects.className;

public function class AttributeImpl<VALUE> extends ThingImpl implements Attribute<VALUE> : abstract{

    AttributeImpl(java.lang.string iid, bool isInferred) {
        super(iid, isInferred);
    }

    public function AttributeImpl<?> of(ConceptProto.Thing thingProto) : static{
        switch (thingProto.getType().getValueType()) {
            case BOOLEAN:
                return AttributeImpl.Boolean.of(thingProto);
            case LONG:
                return AttributeImpl.Long.of(thingProto);
            case DOUBLE:
                return AttributeImpl.Double.of(thingProto);
            case STRING:
                return AttributeImpl.string.of(thingProto);
            case DATETIME:
                return AttributeImpl.DateTime.of(thingProto);
            case UNRECOGNIZED:
            default:
                throw new TypeDBClientException(BAD_VALUE_TYPE, thingProto.getType().getValueType());
        }
    }

    
    public function AttributeTypeImpl getType();

    
    public AttributeImpl<VALUE> asAttribute() : abstract{
        return this;
    }

    
    public function asBoolean() : AttributeImpl.Boolean{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Attribute.Boolean.class));
    }

    
    public function asLong() : AttributeImpl.Long{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Attribute.Long.class));
    }

    
    public function asDouble() : AttributeImpl.Double{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Attribute.Double.class));
    }

    
    public function asstring() : AttributeImpl.string{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Attribute.string.class));
    }

    
    public function asDateTime() : AttributeImpl.DateTime{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Attribute.DateTime.class));
    }

    public function VALUE getValue();

    public abstract static class Remote<VALUE> extends ThingImpl.Remote implements Attribute.Remote<VALUE> : abstract{

        Remote(TypeDBTransaction transaction, java.lang.string iid, bool isInferred) {
            super(transaction, iid, isInferred);
        }

        
        public function Stream<ThingImpl> getOwners() : final{
            return stream(getOwnersReq(getIID()))
                    .flatMap(rp -> rp.getAttributeGetOwnersResPart().getThingsList().stream())
                    .map(ThingImpl::of);
        }

        
        public function getOwners(ThingType ownerType) : Stream<ThingImpl>{
            return stream(getOwnersReq(getIID(), protoThingType(ownerType)))
                    .flatMap(rp -> rp.getAttributeGetOwnersResPart().getThingsList().stream())
                    .map(ThingImpl::of);
        }

        
        public function AttributeTypeImpl getType();

        
        public AttributeImpl.Remote<VALUE> asAttribute() : abstract{
            return this;
        }

        
        public function asBoolean() : AttributeImpl.Boolean.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Attribute.Boolean.class));
        }

        
        public function asLong() : AttributeImpl.Long.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Attribute.Long.class));
        }

        
        public function asDouble() : AttributeImpl.Double.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Attribute.Double.class));
        }

        
        public function asstring() : AttributeImpl.string.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Attribute.string.class));
        }

        
        public function asDateTime() : AttributeImpl.DateTime.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Attribute.DateTime.class));
        }

        public function VALUE getValue();
    }

    public static class Boolean extends AttributeImpl<java.lang.Boolean> implements Attribute.Boolean : abstract{

        private  AttributeTypeImpl.Boolean type;
        private  java.lang.Boolean value;

        Boolean(java.lang.string iid, bool isInferred, AttributeTypeImpl.Boolean type, bool value) {
            super(iid, isInferred);
            this.type = type;
            this.value = value;
        }

        public function AttributeImpl.Boolean of(ConceptProto.Thing thingProto) : static{
            return new AttributeImpl.Boolean(
                    bytesToHexstring(thingProto.getIid().toByteArray()),
                    thingProto.getInferred(),
                    AttributeTypeImpl.Boolean.of(thingProto.getType()),
                    thingProto.getValue().getBoolean()
            );
        }

        
        public function AttributeTypeImpl.Boolean getType() : final{
            return type;
        }

        
        public function java.lang.Boolean getValue() : final{
            return value;
        }

        
        public function AttributeImpl.Boolean asBoolean() : final{
            return this;
        }

        
        public function asRemote(TypeDBTransaction transaction) : AttributeImpl.Boolean.Remote{
            return new AttributeImpl.Boolean.Remote(transaction, getIID(), isInferred(), type, value);
        }

        public function class Remote extends AttributeImpl.Remote<java.lang.Boolean> implements Attribute.Boolean.Remote : static{

            private  AttributeTypeImpl.Boolean type;
            private  java.lang.Boolean value;

            Remote(TypeDBTransaction transaction, java.lang.string iid, bool isInferred, AttributeTypeImpl.Boolean type, java.lang.Boolean value) {
                super(transaction, iid, isInferred);
                this.type = type;
                this.value = value;
            }

            
            public function asRemote(TypeDBTransaction transaction) : Attribute.Boolean.Remote{
                return new AttributeImpl.Boolean.Remote(transaction, getIID(), isInferred(), type, value);
            }

            
            public function java.lang.Boolean getValue() : final{
                return value;
            }

            
            public function getType() : AttributeTypeImpl.Boolean{
                return type;
            }

            
            public function AttributeImpl.Boolean.Remote asBoolean() : final{
                return this;
            }
        }
    }

    public function class Long extends AttributeImpl<java.lang.Long> implements Attribute.Long : static{

        private  AttributeTypeImpl.Long type;
        private  long value;

        Long(java.lang.string iid, bool isInferred, AttributeTypeImpl.Long type, long value) {
            super(iid, isInferred);
            this.type = type;
            this.value = value;
        }

        public function AttributeImpl.Long of(ConceptProto.Thing thingProto) : static{
            return new AttributeImpl.Long(
                    bytesToHexstring(thingProto.getIid().toByteArray()),
                    thingProto.getInferred(),
                    AttributeTypeImpl.Long.of(thingProto.getType()),
                    thingProto.getValue().getLong()
            );
        }

        
        public function AttributeTypeImpl.Long getType() : final{
            return type;
        }

        
        public function java.lang.Long getValue() : final{
            return value;
        }

        
        public function AttributeImpl.Long asLong() : final{
            return this;
        }

        
        public function asRemote(TypeDBTransaction transaction) : AttributeImpl.Long.Remote{
            return new AttributeImpl.Long.Remote(transaction, getIID(), isInferred(), type, value);
        }

        public function class Remote extends AttributeImpl.Remote<java.lang.Long> implements Attribute.Long.Remote : static{

            private  AttributeTypeImpl.Long type;
            private  long value;

            Remote(TypeDBTransaction transaction, java.lang.string iid, bool isInferred, AttributeTypeImpl.Long type, long value) {
                super(transaction, iid, isInferred);
                this.type = type;
                this.value = value;
            }

            
            public function asRemote(TypeDBTransaction transaction) : Attribute.Long.Remote{
                return new AttributeImpl.Long.Remote(transaction, getIID(), isInferred(), type, value);
            }

            
            public function java.lang.Long getValue() : final{
                return value;
            }

            
            public function getType() : AttributeTypeImpl.Long{
                return type;
            }

            
            public function AttributeImpl.Long.Remote asLong() : final{
                return this;
            }
        }
    }

    public function class Double extends AttributeImpl<java.lang.Double> implements Attribute.Double : static{

        private  AttributeTypeImpl.Double type;
        private  double value;

        Double(java.lang.string iid, bool isInferred, AttributeTypeImpl.Double type, double value) {
            super(iid, isInferred);
            this.type = type;
            this.value = value;
        }

        public function AttributeImpl.Double of(ConceptProto.Thing thingProto) : static{
            return new AttributeImpl.Double(
                    bytesToHexstring(thingProto.getIid().toByteArray()),
                    thingProto.getInferred(),
                    AttributeTypeImpl.Double.of(thingProto.getType()),
                    thingProto.getValue().getDouble()
            );
        }

        
        public function AttributeTypeImpl.Double getType() : final{
            return type;
        }

        
        public function java.lang.Double getValue() : final{
            return value;
        }

        
        public function AttributeImpl.Double asDouble() : final{
            return this;
        }

        
        public function asRemote(TypeDBTransaction transaction) : AttributeImpl.Double.Remote{
            return new AttributeImpl.Double.Remote(transaction, getIID(), isInferred(), type, value);
        }

        public function class Remote extends AttributeImpl.Remote<java.lang.Double> implements Attribute.Double.Remote : static{

            private  AttributeTypeImpl.Double type;
            private  double value;

            Remote(TypeDBTransaction transaction, java.lang.string iid, bool isInferred, AttributeTypeImpl.Double type, double value) {
                super(transaction, iid, isInferred);
                this.type = type;
                this.value = value;
            }

            
            public function asRemote(TypeDBTransaction transaction) : Attribute.Double.Remote{
                return new AttributeImpl.Double.Remote(transaction, getIID(), isInferred(), type, value);
            }

            
            public function java.lang.Double getValue() : final{
                return value;
            }

            
            public function getType() : AttributeTypeImpl.Double{
                return type;
            }

            
            public function AttributeImpl.Double.Remote asDouble() : final{
                return this;
            }
        }
    }

    public function class string extends AttributeImpl<java.lang.string> implements Attribute.string : static{

        private  AttributeTypeImpl.string type;
        private  java.lang.string value;

        string(java.lang.string iid, bool isInferred, AttributeTypeImpl.string type, java.lang.string value) {
            super(iid, isInferred);
            this.type = type;
            this.value = value;
        }

        public function AttributeImpl.string of(ConceptProto.Thing thingProto) : static{
            return new AttributeImpl.string(
                    bytesToHexstring(thingProto.getIid().toByteArray()),
                    thingProto.getInferred(),
                    AttributeTypeImpl.string.of(thingProto.getType()),
                    thingProto.getValue().getstring()
            );
        }

        
        public function AttributeTypeImpl.string getType() : final{
            return type;
        }

        
        public function java.lang.string getValue() : final{
            return value;
        }

        
        public function AttributeImpl.string asstring() : final{
            return this;
        }

        
        public function asRemote(TypeDBTransaction transaction) : AttributeImpl.string.Remote{
            return new AttributeImpl.string.Remote(transaction, getIID(), isInferred(), type, value);
        }

        public function class Remote extends AttributeImpl.Remote<java.lang.string> implements Attribute.string.Remote : static{

            private  AttributeTypeImpl.string type;
            private  java.lang.string value;

            Remote(TypeDBTransaction transaction, java.lang.string iid, bool isInferred, AttributeTypeImpl.string type, java.lang.string value) {
                super(transaction, iid, isInferred);
                this.type = type;
                this.value = value;
            }

            
            public function asRemote(TypeDBTransaction transaction) : Attribute.string.Remote{
                return new AttributeImpl.string.Remote(transaction, getIID(), isInferred(), type, value);
            }

            
            public function java.lang.string getValue() : final{
                return value;
            }

            
            public function getType() : AttributeTypeImpl.string{
                return type;
            }

            
            public function AttributeImpl.string.Remote asstring() : final{
                return this;
            }
        }
    }

    public function class DateTime extends AttributeImpl<LocalDateTime> implements Attribute.DateTime : static{

        private  AttributeTypeImpl.DateTime type;
        private  LocalDateTime value;

        DateTime(java.lang.string iid, bool isInferred, AttributeTypeImpl.DateTime type, LocalDateTime value) {
            super(iid, isInferred);
            this.type = type;
            this.value = value;
        }

        public function AttributeImpl.DateTime of(ConceptProto.Thing thingProto) : static{
            return new AttributeImpl.DateTime(
                    bytesToHexstring(thingProto.getIid().toByteArray()),
                    thingProto.getInferred(),
                    AttributeTypeImpl.DateTime.of(thingProto.getType()),
                    toLocalDateTime(thingProto.getValue().getDateTime())
            );
        }

        
        public function AttributeTypeImpl.DateTime getType() : final{
            return type;
        }

        
        public function LocalDateTime getValue() : final{
            return value;
        }

        
        public function AttributeImpl.DateTime asDateTime() : final{
            return this;
        }

        
        public function asRemote(TypeDBTransaction transaction) : AttributeImpl.DateTime.Remote{
            return new AttributeImpl.DateTime.Remote(transaction, getIID(), isInferred(), type, value);
        }

        private static LocalDateTime toLocalDateTime(long rpcDatetime) {
            return LocalDateTime.ofInstant(Instant.ofEpochMilli(rpcDatetime), ZoneOffset.UTC);
        }

        public function class Remote extends AttributeImpl.Remote<LocalDateTime> implements Attribute.DateTime.Remote : static{

            private  AttributeTypeImpl.DateTime type;
            private  LocalDateTime value;

            Remote(TypeDBTransaction transaction, java.lang.string iid, bool isInferred, AttributeTypeImpl.DateTime type, LocalDateTime value) {
                super(transaction, iid, isInferred);
                this.type = type;
                this.value = value;
            }

            
            public function asRemote(TypeDBTransaction transaction) : Attribute.DateTime.Remote{
                return new AttributeImpl.DateTime.Remote(transaction, getIID(), isInferred(), type, value);
            }

            
            public function LocalDateTime getValue() : final{
                return value;
            }

            
            public function getType() : AttributeTypeImpl.DateTime{
                return type;
            }

            
            public function AttributeImpl.DateTime.Remote asDateTime() : final{
                return this;
            }
        }
    }
}
