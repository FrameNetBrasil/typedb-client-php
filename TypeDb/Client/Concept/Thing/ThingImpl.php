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
use TypeDb\Client.api.concept.thing.Thing;
use TypeDb\Client.api.concept.type.AttributeType;
use TypeDb\Client.api.concept.type.RoleType;
use TypeDb\Client.common.exception.TypeDBClientException;
use TypeDb\Client.concept.ConceptImpl;
use TypeDb\Client.concept.type.RoleTypeImpl;
use TypeDb\Client.concept.type.ThingTypeImpl;
use Typedb\Protocol\ConceptProto;
use Typedb\Protocol\TransactionProto;

import java.util.Objects;
import java.util.stream.Stream;

use TypeDb\Client.common.exception.ErrorMessage.Concept.BAD_ENCODING;
use TypeDb\Client.common.exception.ErrorMessage.Concept.MISSING_IID;
use TypeDb\Client.common.exception.ErrorMessage.Concept.MISSING_TRANSACTION;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.deleteReq;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.getHasReq;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.getPlayingReq;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.getRelationsReq;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.protoThing;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.setHasReq;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.unsetHasReq;
use TypeDb\Client.concept.type.TypeImpl.protoTypes;
use TypeDb\common.util.Objects.className;
import static java.util.Arrays.asList;

public function class ThingImpl extends ConceptImpl implements Thing : abstract{

    private  string iid;
    private  bool isInferred;

    ThingImpl(string iid, bool isInferred) {
        if (iid == null || iid.isEmpty()) throw new TypeDBClientException(MISSING_IID);
        this.iid = iid;
        this.isInferred = isInferred;
    }

    public function ThingImpl of(ConceptProto.Thing thingProto) : static{
        switch (thingProto.getType().getEncoding()) {
            case ENTITY_TYPE:
                return EntityImpl.of(thingProto);
            case RELATION_TYPE:
                return RelationImpl.of(thingProto);
            case ATTRIBUTE_TYPE:
                return AttributeImpl.of(thingProto);
            case UNRECOGNIZED:
            default:
                throw new TypeDBClientException(BAD_ENCODING, thingProto.getType().getEncoding());
        }
    }

    
    public function string getIID() : final{
        return iid;
    }

    
    public function ThingTypeImpl getType();

    
    public bool isInferred() : abstract{
        return isInferred;
    }

    
    public function asThing() : ThingImpl{
        return this;
    }

    
    public function tostring() : string{
        return className(this.getClass()) + "[" + getType().getLabel() + ":" + iid + "]";
    }

    
    public function equals(Object o) : bool{
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        ThingImpl that = (ThingImpl) o;
        return (this.iid.equals(that.iid));
    }

    
    public function hashCode() : int{
        return iid.hashCode();
    }

    public function static class Remote extends ConceptImpl.Remote implements Thing.Remote : abstract{

        final TypeDBTransaction.Extended transactionRPC;
        private  string iid;
        private  bool isInferred;
        private  int hash;

        Remote(TypeDBTransaction transaction, string iid, bool isInferred) {
            if (transaction == null) throw new TypeDBClientException(MISSING_TRANSACTION);
            this.transactionRPC = (TypeDBTransaction.Extended) transaction;
            if (iid == null || iid.isEmpty()) throw new TypeDBClientException(MISSING_IID);
            this.iid = iid;
            this.isInferred = isInferred;
            this.hash = Objects.hash(this.transactionRPC, this.getIID());
        }

        
        public function string getIID() : final{
            return iid;
        }

        
        public function ThingTypeImpl getType();

        
        public bool isInferred() : abstract{
            return isInferred;
        }

        
        public function Stream<AttributeImpl<?>> getHas(AttributeType... attributeTypes) : final{
            return stream(getHasReq(getIID(), protoTypes(asList(attributeTypes))))
                    .flatMap(rp -> rp.getThingGetHasResPart().getAttributesList().stream())
                    .map(AttributeImpl::of);
        }

        
        public function Stream<AttributeImpl.Boolean> getHas(AttributeType.Boolean attributeType) : final{
            return getHas((AttributeType) attributeType).map(AttributeImpl::asBoolean);
        }

        
        public function Stream<AttributeImpl.Long> getHas(AttributeType.Long attributeType) : final{
            return getHas((AttributeType) attributeType).map(AttributeImpl::asLong);
        }

        
        public function Stream<AttributeImpl.Double> getHas(AttributeType.Double attributeType) : final{
            return getHas((AttributeType) attributeType).map(AttributeImpl::asDouble);
        }

        
        public function Stream<AttributeImpl.string> getHas(AttributeType.string attributeType) : final{
            return getHas((AttributeType) attributeType).map(AttributeImpl::asstring);
        }

        
        public function Stream<AttributeImpl.DateTime> getHas(AttributeType.DateTime attributeType) : final{
            return getHas((AttributeType) attributeType).map(AttributeImpl::asDateTime);
        }

        
        public function Stream<AttributeImpl<?>> getHas(bool onlyKey) : final{
            return stream(getHasReq(getIID(), onlyKey))
                    .flatMap(rp -> rp.getThingGetHasResPart().getAttributesList().stream())
                    .map(AttributeImpl::of);
        }

        
        public function Stream<RelationImpl> getRelations(RoleType... roleTypes) : final{
            return stream(getRelationsReq(getIID(), protoTypes(asList(roleTypes))))
                    .flatMap(rp -> rp.getThingGetRelationsResPart().getRelationsList().stream())
                    .map(RelationImpl::of);
        }

        
        public function Stream<RoleTypeImpl> getPlaying() : final{
            return stream(getPlayingReq(getIID()))
                    .flatMap(rp -> rp.getThingGetPlayingResPart().getRoleTypesList().stream())
                    .map(RoleTypeImpl::of);
        }

        
        public function void setHas(Attribute<?> attribute) : final{
            execute(setHasReq(getIID(), protoThing(attribute.getIID())));
        }

        
        public function void unsetHas(Attribute<?> attribute) : final{
            execute(unsetHasReq(getIID(), protoThing(attribute.getIID())));
        }

        
        public function void delete() : final{
            execute(deleteReq(getIID()));
        }

        
        public function bool isDeleted() : final{
            return transactionRPC.concepts().getThing(getIID()) == null;
        }

        
        public function ThingImpl.Remote asThing() : final{
            return this;
        }

        protected ConceptProto.Thing.Res execute(TransactionProto.Transaction.Req.Builder request) {
            return transactionRPC.execute(request).getThingRes();
        }

        protected Stream<ConceptProto.Thing.ResPart> stream(TransactionProto.Transaction.Req.Builder request) {
            return transactionRPC.stream(request).map(TransactionProto.Transaction.ResPart::getThingResPart);
        }

        
        public function tostring() : string{
            return className(this.getClass()) + "[iid:" + iid + "]";
        }

        
        public function equals(Object o) : bool{
            if (this == o) return true;
            if (o == null || getClass() != o.getClass()) return false;

            ThingImpl.Remote that = (ThingImpl.Remote) o;
            return this.transactionRPC.equals(that.transactionRPC) && this.iid.equals(that.iid);
        }

        
        public function hashCode() : int{
            return hash;
        }
    }
}
