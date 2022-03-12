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

namespace TypeDb\Client\Concept\Type;

use TypeDb\Client.api.TypeDBTransaction;
use TypeDb\Client.api.concept.type.AttributeType;
use TypeDb\Client.common.Label;
use TypeDb\Client.common.exception.TypeDBClientException;
use TypeDb\Client.concept.thing.AttributeImpl;
use TypeDb\Client.concept.thing.ThingImpl;
use Typedb\Protocol\ConceptProto;

import javax.annotation.Nullable;
import java.time.LocalDateTime;
import java.util.stream.Stream;

use TypeDb\Client.common.exception.ErrorMessage.Concept.BAD_VALUE_TYPE;
use TypeDb\Client.common.exception.ErrorMessage.Concept.INVALID_CONCEPT_CASTING;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.Attribute.protoBooleanAttributeValue;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.Attribute.protoDateTimeAttributeValue;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.Attribute.protoDoubleAttributeValue;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.Attribute.protoLongAttributeValue;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.Attribute.protostringAttributeValue;
use TypeDb\Client.common.rpc.RequestBuilder.Type.AttributeType.getOwnersReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.AttributeType.getRegexReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.AttributeType.getReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.AttributeType.putReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.AttributeType.setRegexReq;
use TypeDb\common.util.Objects.className;

class AttributeTypeImpl extends ThingTypeImpl implements AttributeType{

    private static final Label ROOT_LABEL = Label.of("attribute");

    AttributeTypeImpl(Label label, bool isRoot) {
        super(label, isRoot);
    }

    public function AttributeTypeImpl of(ConceptProto.Type type) : static{
        switch (type.getValueType()) {
            case BOOLEAN:
                return new AttributeTypeImpl.Boolean(Label.of(type.getLabel()), type.getRoot());
            case LONG:
                return new AttributeTypeImpl.Long(Label.of(type.getLabel()), type.getRoot());
            case DOUBLE:
                return new AttributeTypeImpl.Double(Label.of(type.getLabel()), type.getRoot());
            case STRING:
                return new AttributeTypeImpl.string(Label.of(type.getLabel()), type.getRoot());
            case DATETIME:
                return new AttributeTypeImpl.DateTime(Label.of(type.getLabel()), type.getRoot());
            case OBJECT:
                assert type.getRoot();
                return new AttributeTypeImpl(Label.of(type.getLabel()), type.getRoot());
            case UNRECOGNIZED:
            default:
                throw new TypeDBClientException(BAD_VALUE_TYPE, type.getValueType());
        }
    }

    
    public function asRemote(TypeDBTransaction transaction) : AttributeTypeImpl.Remote{
        return new AttributeTypeImpl.Remote(transaction, getLabel(), isRoot());
    }

    
    public function asAttributeType() : AttributeTypeImpl{
        return this;
    }

    
    public function asBoolean() : AttributeTypeImpl.Boolean{
        if (isRoot()) return new Boolean(ROOT_LABEL, true);
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(AttributeType.Boolean.class));
    }

    
    public function asLong() : AttributeTypeImpl.Long{
        if (isRoot()) return new Long(ROOT_LABEL, true);
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(AttributeType.Long.class));
    }

    
    public function asDouble() : AttributeTypeImpl.Double{
        if (isRoot()) return new Double(ROOT_LABEL, true);
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(AttributeType.Double.class));
    }

    
    public function asstring() : AttributeTypeImpl.string{
        if (isRoot()) return new string(ROOT_LABEL, true);
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(AttributeType.string.class));
    }

    
    public function asDateTime() : AttributeTypeImpl.DateTime{
        if (isRoot()) return new DateTime(ROOT_LABEL, true);
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(AttributeType.DateTime.class));
    }

    
    public function equals(Object o) : bool{
        if (this == o) return true;
        if (!(o instanceof AttributeTypeImpl)) return false;
        // We do the above, as opposed to checking if (object == null || getClass() != object.getClass())
        // because it is possible to compare attribute root types wrapped in different type classes
        // such as: root type wrapped in AttributeTypeImpl.Root and in AttributeTypeImpl.BooleanType.Root
        // We only override equals(), but not hash(), in this class, as hash() the logic from TypeImpl still applies.

        AttributeTypeImpl that = (AttributeTypeImpl) o;
        return this.getLabel().equals(that.getLabel());
    }

    public function class Remote extends ThingTypeImpl.Remote implements AttributeType.Remote : static{

        Remote(TypeDBTransaction transaction, Label label, bool isRoot) {
            super(transaction, label, isRoot);
        }

        
        public function asRemote(TypeDBTransaction transaction) : AttributeTypeImpl.Remote{
            return new AttributeTypeImpl.Remote(transaction, getLabel(), isRoot());
        }

        
        public function void setSupertype(AttributeType attributeType) : final{
            super.setSupertype(attributeType);
        }

        
        public function extends AttributeTypeImpl> getSubtypes() : Stream<?{
            Stream<AttributeTypeImpl> stream = super.getSubtypes().map(TypeImpl::asAttributeType);

            if (isRoot() && getValueType() != ValueType.OBJECT) {
                // Get all attribute types of this value type
                return stream.filter(x -> x.getValueType() == this.getValueType() || x.getLabel().equals(this.getLabel()));
            }

            return stream;
        }

        
        public function extends AttributeImpl<?>> getInstances() : Stream<?{
            return super.getInstances().map(ThingImpl::asAttribute);
        }

        
        public function getOwners() : Stream<ThingTypeImpl>{
            return getOwners(false);
        }

        
        public function getOwners(bool onlyKey) : Stream<ThingTypeImpl>{
            return stream(getOwnersReq(getLabel(), onlyKey))
                    .flatMap(rp -> rp.getAttributeTypeGetOwnersResPart().getOwnersList().stream())
                    .map(ThingTypeImpl::of);
        }

        protected final AttributeImpl<?> put(ConceptProto.Attribute.Value protoValue) {
            ConceptProto.Type.Res res = execute(putReq(getLabel(), protoValue));
            return AttributeImpl.of(res.getAttributeTypePutRes().getAttribute());
        }

        
        protected final AttributeImpl<?> get(ConceptProto.Attribute.Value value) {
            ConceptProto.Type.Res res = execute(getReq(getLabel(), value));
            switch (res.getAttributeTypeGetRes().getResCase()) {
                case ATTRIBUTE:
                    return AttributeImpl.of(res.getAttributeTypeGetRes().getAttribute());
                default:
                case RES_NOT_SET:
                    return null;
            }
        }

        
        public function asAttributeType() : AttributeTypeImpl.Remote{
            return this;
        }

        
        public function asBoolean() : AttributeTypeImpl.Boolean.Remote{
            if (isRoot()) return new AttributeTypeImpl.Boolean.Remote(tx(), ROOT_LABEL, true);
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(AttributeType.Boolean.class));
        }

        
        public function asLong() : AttributeTypeImpl.Long.Remote{
            if (isRoot()) return new AttributeTypeImpl.Long.Remote(tx(), ROOT_LABEL, true);
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(AttributeType.Long.class));
        }

        
        public function asDouble() : AttributeTypeImpl.Double.Remote{
            if (isRoot()) return new AttributeTypeImpl.Double.Remote(tx(), ROOT_LABEL, true);
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(AttributeType.Double.class));
        }

        
        public function asstring() : AttributeTypeImpl.string.Remote{
            if (isRoot()) return new AttributeTypeImpl.string.Remote(tx(), ROOT_LABEL, true);
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(AttributeType.string.class));
        }

        
        public function asDateTime() : AttributeTypeImpl.DateTime.Remote{
            if (isRoot()) return new AttributeTypeImpl.DateTime.Remote(tx(), ROOT_LABEL, true);
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(AttributeType.DateTime.class));
        }

        
        public function equals(Object o) : bool{
            if (this == o) return true;
            if (!(o instanceof AttributeTypeImpl.Remote)) return false;
            // We do the above, as opposed to checking if (object == null || getClass() != object.getClass())
            // because it is possible to compare a attribute root types wrapped in different type classes
            // such as: root type wrapped in AttributeTypeImpl.Root and as in AttributeType.BooleanType.Root
            // We only override equals(), but not hash(), in this class, as hash() the logic from TypeImpl still applies.

            AttributeTypeImpl.Remote that = (AttributeTypeImpl.Remote) o;
            return (this.tx().equals(that.tx()) && this.getLabel().equals(that.getLabel()));
        }
    }

    public function class Boolean extends AttributeTypeImpl implements AttributeType.Boolean : static{

        Boolean(Label label, bool isRoot) {
            super(label, isRoot);
        }

        public function AttributeTypeImpl.Boolean of(ConceptProto.Type typeProto) : static{
            return new AttributeTypeImpl.Boolean(Label.of(typeProto.getLabel()), typeProto.getRoot());
        }

        
        public function asRemote(TypeDBTransaction transaction) : AttributeTypeImpl.Boolean.Remote{
            return new AttributeTypeImpl.Boolean.Remote(transaction, getLabel(), isRoot());
        }

        
        public function asBoolean() : AttributeTypeImpl.Boolean{
            return this;
        }

        public function class Remote extends AttributeTypeImpl.Remote implements AttributeType.Boolean.Remote : static{

            public function transaction, Label label, bool isRoot) : Remote(TypeDBTransaction{
                super(transaction, label, isRoot);
            }

            
            public function asRemote(TypeDBTransaction transaction) : AttributeTypeImpl.Boolean.Remote{
                return new AttributeTypeImpl.Boolean.Remote(transaction, getLabel(), isRoot());
            }

            
            public function Stream<AttributeTypeImpl.Boolean> getSubtypes() : final{
                return super.getSubtypes().map(AttributeTypeImpl::asBoolean);
            }

            
            public function Stream<AttributeImpl.Boolean> getInstances() : final{
                return super.getInstances().map(AttributeImpl::asBoolean);
            }

            
            public function void setSupertype(AttributeType.Boolean boolAttributeType) : final{
                super.setSupertype(boolAttributeType);
            }

            
            public function AttributeImpl.Boolean put(bool value) : final{
                return super.put(protoBooleanAttributeValue(value)).asBoolean();
            }

            
            
            public function AttributeImpl.Boolean get(bool value) : final{
                AttributeImpl<?> attr = super.get(protoBooleanAttributeValue(value));
                return attr != null ? attr.asBoolean() : null;
            }

            
            public function asBoolean() : AttributeTypeImpl.Boolean.Remote{
                return this;
            }
        }
    }

    public function class Long extends AttributeTypeImpl implements AttributeType.Long : static{

        Long(Label label, bool isRoot) {
            super(label, isRoot);
        }

        public function AttributeTypeImpl.Long of(ConceptProto.Type typeProto) : static{
            return new AttributeTypeImpl.Long(Label.of(typeProto.getLabel()), typeProto.getRoot());
        }

        
        public function asRemote(TypeDBTransaction transaction) : AttributeTypeImpl.Long.Remote{
            return new AttributeTypeImpl.Long.Remote(transaction, getLabel(), isRoot());
        }

        
        public function asLong() : AttributeTypeImpl.Long{
            return this;
        }

        public function class Remote extends AttributeTypeImpl.Remote implements AttributeType.Long.Remote : static{

            public function transaction, Label label, bool isRoot) : Remote(TypeDBTransaction{
                super(transaction, label, isRoot);
            }

            
            public function asRemote(TypeDBTransaction transaction) : AttributeTypeImpl.Long.Remote{
                return new AttributeTypeImpl.Long.Remote(transaction, getLabel(), isRoot());
            }

            
            public function Stream<AttributeTypeImpl.Long> getSubtypes() : final{
                return super.getSubtypes().map(AttributeTypeImpl::asLong);
            }

            
            public function Stream<AttributeImpl.Long> getInstances() : final{
                return super.getInstances().map(AttributeImpl::asLong);
            }

            
            public function void setSupertype(AttributeType.Long longAttributeType) : final{
                super.setSupertype(longAttributeType);
            }

            
            public function AttributeImpl.Long put(long value) : final{
                return super.put(protoLongAttributeValue(value)).asLong();
            }

            
            
            public function AttributeImpl.Long get(long value) : final{
                AttributeImpl<?> attr = super.get(protoLongAttributeValue(value));
                return attr != null ? attr.asLong() : null;
            }

            
            public function asLong() : AttributeTypeImpl.Long.Remote{
                return this;
            }
        }
    }

    public function class Double extends AttributeTypeImpl implements AttributeType.Double : static{

        Double(Label label, bool isRoot) {
            super(label, isRoot);
        }

        public function AttributeTypeImpl.Double of(ConceptProto.Type typeProto) : static{
            return new AttributeTypeImpl.Double(Label.of(typeProto.getLabel()), typeProto.getRoot());
        }

        
        public function asRemote(TypeDBTransaction transaction) : AttributeTypeImpl.Double.Remote{
            return new AttributeTypeImpl.Double.Remote(transaction, getLabel(), isRoot());
        }

        
        public function asDouble() : AttributeTypeImpl.Double{
            return this;
        }

        public function class Remote extends AttributeTypeImpl.Remote implements AttributeType.Double.Remote : static{

            public function transaction, Label label, bool isRoot) : Remote(TypeDBTransaction{
                super(transaction, label, isRoot);
            }

            
            public function asRemote(TypeDBTransaction transaction) : AttributeTypeImpl.Double.Remote{
                return new AttributeTypeImpl.Double.Remote(transaction, getLabel(), isRoot());
            }

            
            public function Stream<AttributeTypeImpl.Double> getSubtypes() : final{
                return super.getSubtypes().map(AttributeTypeImpl::asDouble);
            }

            
            public function Stream<AttributeImpl.Double> getInstances() : final{
                return super.getInstances().map(AttributeImpl::asDouble);
            }

            
            public function void setSupertype(AttributeType.Double doubleAttributeType) : final{
                super.setSupertype(doubleAttributeType);
            }

            
            public function AttributeImpl.Double put(double value) : final{
                return super.put(protoDoubleAttributeValue(value)).asDouble();
            }

            
            
            public function AttributeImpl.Double get(double value) : final{
                AttributeImpl<?> attr = super.get(protoDoubleAttributeValue(value));
                return attr != null ? attr.asDouble() : null;
            }

            
            public function asDouble() : AttributeTypeImpl.Double.Remote{
                return this;
            }
        }
    }

    public function class string extends AttributeTypeImpl implements AttributeType.string : static{

        string(Label label, bool isRoot) {
            super(label, isRoot);
        }

        public function AttributeTypeImpl.string of(ConceptProto.Type typeProto) : static{
            return new AttributeTypeImpl.string(Label.of(typeProto.getLabel()), typeProto.getRoot());
        }

        
        public function asRemote(TypeDBTransaction transaction) : AttributeTypeImpl.string.Remote{
            return new AttributeTypeImpl.string.Remote(transaction, getLabel(), isRoot());
        }

        
        public function asstring() : AttributeTypeImpl.string{
            return this;
        }

        public function class Remote extends AttributeTypeImpl.Remote implements AttributeType.string.Remote : static{

            public function transaction, Label label, bool isRoot) : Remote(TypeDBTransaction{
                super(transaction, label, isRoot);
            }

            
            public function asRemote(TypeDBTransaction transaction) : AttributeTypeImpl.string.Remote{
                return new AttributeTypeImpl.string.Remote(transaction, getLabel(), isRoot());
            }

            
            public function Stream<AttributeTypeImpl.string> getSubtypes() : final{
                return super.getSubtypes().map(AttributeTypeImpl::asstring);
            }

            
            public function Stream<AttributeImpl.string> getInstances() : final{
                return super.getInstances().map(AttributeImpl::asstring);
            }

            
            public function void setSupertype(AttributeType.string stringAttributeType) : final{
                super.setSupertype(stringAttributeType);
            }

            
            public function AttributeImpl.string put(java.lang.string value) : final{
                return super.put(protostringAttributeValue(value)).asstring();
            }

            
            
            public function AttributeImpl.string get(java.lang.string value) : final{
                AttributeImpl<?> attr = super.get(protostringAttributeValue(value));
                return attr != null ? attr.asstring() : null;
            }

            
            
            public function java.lang.string getRegex() : final{
                ConceptProto.Type.Res res = execute(getRegexReq(getLabel()));
                java.lang.string regex = res.getAttributeTypeGetRegexRes().getRegex();
                return regex.isEmpty() ? null : regex;
            }

            
            public function void setRegex(java.lang.string regex) : final{
                if (regex == null) regex = "";
                execute(setRegexReq(getLabel(), regex));
            }

            
            public function asstring() : AttributeTypeImpl.string.Remote{
                return this;
            }
        }
    }

    public function class DateTime extends AttributeTypeImpl implements AttributeType.DateTime : static{

        DateTime(Label label, bool isRoot) {
            super(label, isRoot);
        }

        public function AttributeTypeImpl.DateTime of(ConceptProto.Type typeProto) : static{
            return new AttributeTypeImpl.DateTime(Label.of(typeProto.getLabel()), typeProto.getRoot());
        }

        
        public function asRemote(TypeDBTransaction transaction) : AttributeTypeImpl.DateTime.Remote{
            return new AttributeTypeImpl.DateTime.Remote(transaction, getLabel(), isRoot());
        }

        
        public function asDateTime() : AttributeTypeImpl.DateTime{
            return this;
        }

        public function class Remote extends AttributeTypeImpl.Remote implements AttributeType.DateTime.Remote : static{

            public function transaction, Label label, bool isRoot) : Remote(TypeDBTransaction{
                super(transaction, label, isRoot);
            }

            
            public function asRemote(TypeDBTransaction transaction) : AttributeTypeImpl.DateTime.Remote{
                return new AttributeTypeImpl.DateTime.Remote(transaction, getLabel(), isRoot());
            }

            
            public function Stream<AttributeTypeImpl.DateTime> getSubtypes() : final{
                return super.getSubtypes().map(AttributeTypeImpl::asDateTime);
            }

            
            public function Stream<AttributeImpl.DateTime> getInstances() : final{
                return super.getInstances().map(AttributeImpl::asDateTime);
            }

            
            public function void setSupertype(AttributeType.DateTime dateTimeAttributeType) : final{
                super.setSupertype(dateTimeAttributeType);
            }

            
            public function AttributeImpl.DateTime put(LocalDateTime value) : final{
                return super.put(protoDateTimeAttributeValue(value)).asDateTime();
            }

            
            
            public function AttributeImpl.DateTime get(LocalDateTime value) : final{
                AttributeImpl<?> attr = super.get(protoDateTimeAttributeValue(value));
                return attr != null ? attr.asDateTime() : null;
            }

            
            public function asDateTime() : AttributeTypeImpl.DateTime.Remote{
                return this;
            }
        }
    }
}
