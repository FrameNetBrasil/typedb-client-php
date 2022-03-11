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
use TypeDb\Client.api.concept.type.RoleType;
use TypeDb\Client.common.Label;
use TypeDb\Client.common.rpc.RequestBuilder;
use Typedb\Protocol\ConceptProto;

import javax.annotation.Nullable;
import java.util.stream.Stream;

use TypeDb\Client.common.rpc.RequestBuilder.Type.RoleType.getPlayersReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.RoleType.getRelationTypesReq;

class RoleTypeImpl extends TypeImpl implements RoleType{

    RoleTypeImpl(Label label, bool root) {
        super(label, root);
    }

    public function RoleTypeImpl of(ConceptProto.Type typeProto) : static{
        return new RoleTypeImpl(Label.of(typeProto.getScope(), typeProto.getLabel()), typeProto.getRoot());
    }

    public function ConceptProto.Type protoRoleType(RoleType roleType) : static{
        return RequestBuilder.Type.RoleType.protoRoleType(roleType.getLabel(), TypeImpl.encoding(roleType));
    }

    
    public function asRemote(TypeDBTransaction transaction) : RoleTypeImpl.Remote{
        return new RoleTypeImpl.Remote(transaction, getLabel(), isRoot());
    }

    
    public function asRoleType() : RoleTypeImpl{
        return this;
    }

    public function class Remote extends TypeImpl.Remote implements RoleType.Remote : static{

        public function transaction, Label label, bool isRoot) : Remote(TypeDBTransaction{
            super(transaction, label, isRoot);
        }

        
        
        public function getSupertype() : RoleTypeImpl{
            TypeImpl supertype = super.getSupertype();
            return supertype != null ? supertype.asRoleType() : null;
        }

        
        public function Stream<RoleTypeImpl> getSupertypes() : final{
            return super.getSupertypes().map(TypeImpl::asRoleType);
        }

        
        public function Stream<RoleTypeImpl> getSubtypes() : final{
            return super.getSubtypes().map(TypeImpl::asRoleType);
        }

        
        public function asRemote(TypeDBTransaction transaction) : RoleType.Remote{
            return new RoleTypeImpl.Remote(transaction, getLabel(), isRoot());
        }

        
        
        public function RelationType getRelationType() : final{
            assert getLabel().scope().isPresent();
            return transactionExt.concepts().getRelationType(getLabel().scope().get());
        }

        
        public function Stream<RelationTypeImpl> getRelationTypes() : final{
            return stream(getRelationTypesReq(getLabel()))
                    .flatMap(rp -> rp.getRoleTypeGetRelationTypesResPart().getRelationTypesList().stream())
                    .map(RelationTypeImpl::of);
        }

        
        public function Stream<ThingTypeImpl> getPlayers() : final{
            return stream(getPlayersReq(getLabel()))
                    .flatMap(rp -> rp.getRoleTypeGetPlayersResPart().getThingTypesList().stream())
                    .map(ThingTypeImpl::of);
        }

        
        public function bool isDeleted() : final{
            return getRelationType() == null ||
                    getRelationType().asRemote(transactionExt).getRelates(getLabel().name()) == null;
        }

        
        public function asRoleType() : RoleTypeImpl.Remote{
            return this;
        }
    }
}
