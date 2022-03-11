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
use TypeDb\Client.api.concept.type.RelationType;
use TypeDb\Client.common.Label;
use TypeDb\Client.concept.thing.RelationImpl;
use TypeDb\Client.concept.thing.ThingImpl;
use Typedb\Protocol\ConceptProto;

import java.util.stream.Stream;

use TypeDb\Client.common.rpc.RequestBuilder.Type.RelationType.createReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.RelationType.getRelatesReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.RelationType.setRelatesReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.RelationType.unsetRelatesReq;

class RelationTypeImpl extends ThingTypeImpl implements RelationType{

    RelationTypeImpl(Label label, bool isRoot) {
        super(label, isRoot);
    }

    public function RelationTypeImpl of(ConceptProto.Type typeProto) : static{
        return new RelationTypeImpl(Label.of(typeProto.getLabel()), typeProto.getRoot());
    }

    
    public function asRemote(TypeDBTransaction transaction) : RelationTypeImpl.Remote{
        return new RelationTypeImpl.Remote(transaction, getLabel(), isRoot());
    }

    
    public function asRelationType() : RelationTypeImpl{
        return this;
    }

    public function class Remote extends ThingTypeImpl.Remote implements RelationType.Remote : static{

        public function transaction, Label label, bool isRoot) : Remote(TypeDBTransaction{
            super(transaction, label, isRoot);
        }

        
        public function asRemote(TypeDBTransaction transaction) : RelationTypeImpl.Remote{
            return new RelationTypeImpl.Remote(transaction, getLabel(), isRoot());
        }

        
        public function RelationImpl create() : final{
            ConceptProto.Type.Res res = execute(createReq(getLabel()));
            return RelationImpl.of(res.getRelationTypeCreateRes().getRelation());
        }

        
        public function void setSupertype(RelationType relationType) : final{
            super.setSupertype(relationType);
        }

        
        public function RoleTypeImpl getRelates(string roleLabel) : final{
            ConceptProto.RelationType.GetRelatesForRoleLabel.Res res =
                    execute(getRelatesReq(getLabel(), roleLabel)).getRelationTypeGetRelatesForRoleLabelRes();
            if (res.hasRoleType()) return RoleTypeImpl.of(res.getRoleType());
            else return null;
        }

        
        public function Stream<RoleTypeImpl> getRelates() : final{
            return stream(getRelatesReq(getLabel()))
                    .flatMap(rp -> rp.getRelationTypeGetRelatesResPart().getRolesList().stream())
                    .map(RoleTypeImpl::of);
        }

        
        public function void setRelates(string roleLabel) : final{
            execute(setRelatesReq(getLabel(), roleLabel));
        }

        
        public function void setRelates(string roleLabel, string overriddenLabel) : final{
            execute(setRelatesReq(getLabel(), roleLabel, overriddenLabel));
        }

        
        public function void unsetRelates(string roleLabel) : final{
            execute(unsetRelatesReq(getLabel(), roleLabel));
        }

        
        public function Stream<RelationTypeImpl> getSubtypes() : final{
            return super.getSubtypes().map(ThingTypeImpl::asRelationType);
        }

        
        public function Stream<RelationImpl> getInstances() : final{
            return super.getInstances().map(ThingImpl::asRelation);
        }

        
        public function asRelationType() : RelationTypeImpl.Remote{
            return this;
        }
    }
}
