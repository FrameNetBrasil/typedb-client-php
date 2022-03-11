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
use TypeDb\Client.api.concept.type.AttributeType.ValueType;
use TypeDb\Client.api.concept.type.RoleType;
use TypeDb\Client.api.concept.type.ThingType;
use TypeDb\Client.common.Label;
use TypeDb\Client.common.exception.TypeDBClientException;
use TypeDb\Client.common.rpc.RequestBuilder;
use TypeDb\Client.concept.thing.ThingImpl;
use Typedb\Protocol\ConceptProto;

import java.util.stream.Stream;

use TypeDb\Client.common.exception.ErrorMessage.Concept.BAD_ENCODING;
use TypeDb\Client.common.rpc.RequestBuilder.Type.ThingType.getInstancesReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.ThingType.getOwnsReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.ThingType.getPlaysReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.ThingType.setAbstractReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.ThingType.setOwnsReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.ThingType.setPlaysReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.ThingType.setSupertypeReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.ThingType.unsetAbstractReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.ThingType.unsetOwnsReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.ThingType.unsetPlaysReq;
use TypeDb\Client.concept.type.RoleTypeImpl.protoRoleType;

class ThingTypeImpl extends TypeImpl implements ThingType{

    ThingTypeImpl(Label label, bool isRoot) {
        super(label, isRoot);
    }

    public function ThingTypeImpl of(ConceptProto.Type typeProto) : static{
        switch (typeProto.getEncoding()) {
            case ENTITY_TYPE:
                return EntityTypeImpl.of(typeProto);
            case RELATION_TYPE:
                return RelationTypeImpl.of(typeProto);
            case ATTRIBUTE_TYPE:
                return AttributeTypeImpl.of(typeProto);
            case THING_TYPE:
                assert typeProto.getRoot();
                return new ThingTypeImpl(Label.of(typeProto.getLabel()), typeProto.getRoot());
            case UNRECOGNIZED:
            default:
                throw new TypeDBClientException(BAD_ENCODING, typeProto.getEncoding());
        }
    }

    public function ConceptProto.Type protoThingType(ThingType thingType) : static{
        return RequestBuilder.Type.ThingType.protoThingType(thingType.getLabel(), TypeImpl.encoding(thingType));
    }

    
    public function asRemote(TypeDBTransaction transaction) : ThingTypeImpl.Remote{
        return new ThingTypeImpl.Remote(transaction, getLabel(), isRoot());
    }

    
    public function ThingTypeImpl asThingType() : final{
        return this;
    }

    public function class Remote extends TypeImpl.Remote implements ThingType.Remote : static{

        Remote(TypeDBTransaction transaction, Label label, bool isRoot) {
            super(transaction, label, isRoot);
        }

        void setSupertype(ThingType thingType) {
            execute(setSupertypeReq(getLabel(), protoThingType(thingType)));
        }

        
        public function getSupertype() : ThingTypeImpl{
            TypeImpl supertype = super.getSupertype();
            return supertype != null ? supertype.asThingType() : null;
        }

        
        public function extends ThingTypeImpl> getSupertypes() : Stream<?{
            Stream<? extends TypeImpl> supertypes = super.getSupertypes();
            return supertypes.map(TypeImpl::asThingType);
        }

        
        public function extends ThingTypeImpl> getSubtypes() : Stream<?{
            return super.getSubtypes().map(TypeImpl::asThingType);
        }

        
        public function extends ThingImpl> getInstances() : Stream<?{
            return stream(getInstancesReq(getLabel()))
                    .flatMap(rp -> rp.getThingTypeGetInstancesResPart().getThingsList().stream())
                    .map(ThingImpl::of);
        }

        
        public function void setAbstract() : final{
            execute(setAbstractReq(getLabel()));
        }

        
        public function void unsetAbstract() : final{
            execute(unsetAbstractReq(getLabel()));
        }

        
        public function void setPlays(RoleType roleType) : final{
            execute(setPlaysReq(getLabel(), protoRoleType(roleType)));
        }

        
        public function void setPlays(RoleType roleType, RoleType overriddenRoleType) : final{
            execute(setPlaysReq(getLabel(), protoRoleType(roleType), protoRoleType(overriddenRoleType)));
        }

        
        public function setOwns(AttributeType attributeType) : void{
            setOwns(attributeType, false);
        }

        
        public function setOwns(AttributeType attributeType, bool isKey) : void{
            execute(setOwnsReq(getLabel(), protoThingType(attributeType), isKey));
        }

        
        public function setOwns(AttributeType attributeType, AttributeType overriddenType) : void{
            setOwns(attributeType, overriddenType, false);
        }

        
        public function void setOwns(AttributeType attributeType, AttributeType overriddenType, bool isKey) : final{
            execute(setOwnsReq(getLabel(), protoThingType(attributeType), protoThingType(overriddenType), isKey));
        }

        
        public function Stream<RoleTypeImpl> getPlays() : final{
            return stream(getPlaysReq(getLabel()))
                    .flatMap(rp -> rp.getThingTypeGetPlaysResPart().getRolesList().stream())
                    .map(RoleTypeImpl::of);
        }

        
        public function getOwns() : Stream<AttributeTypeImpl>{
            return getOwns(false);
        }

        
        public function getOwns(ValueType valueType) : Stream<AttributeTypeImpl>{
            return getOwns(valueType, false);
        }

        
        public function getOwns(bool keysOnly) : Stream<AttributeTypeImpl>{
            return stream(getOwnsReq(getLabel(), keysOnly))
                    .flatMap(rp -> rp.getThingTypeGetOwnsResPart().getAttributeTypesList().stream())
                    .map(AttributeTypeImpl::of);
        }

        
        public function Stream<AttributeTypeImpl> getOwns(ValueType valueType, bool keysOnly) : final{
            return stream(getOwnsReq(getLabel(), valueType.proto(), keysOnly))
                    .flatMap(rp -> rp.getThingTypeGetOwnsResPart().getAttributeTypesList().stream())
                    .map(AttributeTypeImpl::of);
        }

        
        public function void unsetPlays(RoleType roleType) : final{
            execute(unsetPlaysReq(getLabel(), protoRoleType(roleType)));
        }

        
        public function void unsetOwns(AttributeType attributeType) : final{
            execute(unsetOwnsReq(getLabel(), protoThingType(attributeType)));
        }

        
        public function asRemote(TypeDBTransaction transaction) : ThingTypeImpl.Remote{
            return new ThingTypeImpl.Remote(transaction, getLabel(), isRoot());
        }

        
        public function ThingTypeImpl.Remote asThingType() : final{
            return this;
        }

        
        public function bool isDeleted() : final{
            return transactionExt.concepts().getThingType(getLabel().name()) == null;
        }
    }
}
