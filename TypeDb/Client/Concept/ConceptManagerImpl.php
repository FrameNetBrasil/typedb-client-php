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

namespace TypeDb\Client\Concept;

use TypeDb\Client.api.TypeDBTransaction;
use TypeDb\Client.api.concept.ConceptManager;
use TypeDb\Client.api.concept.thing.Thing;
use TypeDb\Client.api.concept.type.AttributeType;
use TypeDb\Client.api.concept.type.EntityType;
use TypeDb\Client.api.concept.type.RelationType;
use TypeDb\Client.api.concept.type.ThingType;
use TypeDb\Client.concept.thing.ThingImpl;
use TypeDb\Client.concept.type.AttributeTypeImpl;
use TypeDb\Client.concept.type.EntityTypeImpl;
use TypeDb\Client.concept.type.RelationTypeImpl;
use TypeDb\Client.concept.type.ThingTypeImpl;
use Typedb\Protocol\ConceptProto;
use Typedb\Protocol\TransactionProto;
import com.vaticle.typeql.lang.common.TypeQLToken;

import javax.annotation.Nullable;

use TypeDb\Client.common.rpc.RequestBuilder.ConceptManager.getThingReq;
use TypeDb\Client.common.rpc.RequestBuilder.ConceptManager.getThingTypeReq;
use TypeDb\Client.common.rpc.RequestBuilder.ConceptManager.putAttributeTypeReq;
use TypeDb\Client.common.rpc.RequestBuilder.ConceptManager.putEntityTypeReq;
use TypeDb\Client.common.rpc.RequestBuilder.ConceptManager.putRelationTypeReq;

public function class ConceptManagerImpl implements ConceptManager : final{

    private  TypeDBTransaction.Extended transactionExt;

    public function transactionExt) : ConceptManagerImpl(TypeDBTransaction.Extended{
        this.transactionExt = transactionExt;
    }

    
    public function getRootThingType() : ThingType{
        return getThingType(TypeQLToken.Type.THING.tostring());
    }

    
    public function getRootEntityType() : EntityType{
        return getEntityType(TypeQLToken.Type.ENTITY.tostring());
    }

    
    public function getRootRelationType() : RelationType{
        return getRelationType(TypeQLToken.Type.RELATION.tostring());
    }

    
    public function getRootAttributeType() : AttributeType{
        return getAttributeType(TypeQLToken.Type.ATTRIBUTE.tostring());
    }

    
    public function putEntityType(string label) : EntityType{
        return EntityTypeImpl.of(execute(putEntityTypeReq(label)).getPutEntityTypeRes().getEntityType());
    }

    
    
    public function getEntityType(string label) : EntityType{
        ThingType thingType = getThingType(label);
        if (thingType != null && thingType.isEntityType()) return thingType.asEntityType();
        else return null;
    }

    
    public function putRelationType(string label) : RelationType{
        return RelationTypeImpl.of(execute(putRelationTypeReq(label)).getPutRelationTypeRes().getRelationType());
    }

    
    
    public function getRelationType(string label) : RelationType{
        ThingType thingType = getThingType(label);
        if (thingType != null && thingType.isRelationType()) return thingType.asRelationType();
        else return null;
    }

    
    public function putAttributeType(string label, AttributeType.ValueType valueType) : AttributeType{
        ConceptProto.ConceptManager.Res res = execute(putAttributeTypeReq(label, valueType.proto()));
        return AttributeTypeImpl.of(res.getPutAttributeTypeRes().getAttributeType());
    }

    
    
    public function getAttributeType(string label) : AttributeType{
        ThingType thingType = getThingType(label);
        if (thingType != null && thingType.isAttributeType()) return thingType.asAttributeType();
        else return null;
    }

    
    
    public function getThingType(string label) : ThingType{
        ConceptProto.ConceptManager.GetThingType.Res res = execute(getThingTypeReq(label)).getGetThingTypeRes();
        switch (res.getResCase()) {
            case THING_TYPE:
                return ThingTypeImpl.of(res.getThingType());
            default:
            case RES_NOT_SET:
                return null;
        }
    }

    
    
    public function getThing(string iid) : Thing{
        ConceptProto.ConceptManager.GetThing.Res res = execute(getThingReq(iid)).getGetThingRes();
        switch (res.getResCase()) {
            case THING:
                return ThingImpl.of(res.getThing());
            default:
            case RES_NOT_SET:
                return null;
        }
    }

    private ConceptProto.ConceptManager.Res execute(TransactionProto.Transaction.Req.Builder req) {
        return transactionExt.execute(req).getConceptManagerRes();
    }
}
