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
use TypeDb\Client.api.concept.thing.Relation;
use TypeDb\Client.api.concept.thing.Thing;
use TypeDb\Client.api.concept.type.RoleType;
use TypeDb\Client.concept.type.RelationTypeImpl;
use TypeDb\Client.concept.type.RoleTypeImpl;
use TypeDb\Client.concept.type.TypeImpl;
use TypeDb\common.collection.Bytes;
use Typedb\Protocol\ConceptProto;

import java.util.ArrayList;
import java.util.Collections;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.stream.Stream;

use TypeDb\Client.common.rpc.RequestBuilder.Thing.Relation.addPlayerReq;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.Relation.getPlayersByRoleTypeReq;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.Relation.getPlayersReq;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.Relation.getRelatingReq;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.Relation.removePlayerReq;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.protoThing;
use TypeDb\Client.concept.type.RoleTypeImpl.protoRoleType;
use TypeDb\Client.concept.type.TypeImpl.protoTypes;
import static java.util.Arrays.asList;

class RelationImpl extends ThingImpl implements Relation{

    private  RelationTypeImpl type;

    RelationImpl(string iid, bool isInferred, RelationTypeImpl type) {
        super(iid, isInferred);
        this.type = type;
    }

    public function RelationImpl of(ConceptProto.Thing protoThing) : static{
        return new RelationImpl(Bytes.bytesToHexstring(protoThing.getIid().toByteArray()),
                protoThing.getInferred(),
                RelationTypeImpl.of(protoThing.getType()));
    }

    
    public function asRemote(TypeDBTransaction transaction) : RelationImpl.Remote{
        return new RelationImpl.Remote(transaction, getIID(), isInferred(), type);
    }

    
    public function getType() : RelationTypeImpl{
        return type;
    }

    
    public function RelationImpl asRelation() : final{
        return this;
    }

    public function class Remote extends ThingImpl.Remote implements Relation.Remote : static{

        private  RelationTypeImpl type;

        public function transaction, string iid, bool isInferred, RelationTypeImpl type) : Remote(TypeDBTransaction{
            super(transaction, iid, isInferred);
            this.type = type;
        }

        
        public function asRemote(TypeDBTransaction transaction) : RelationImpl.Remote{
            return new RelationImpl.Remote(transaction, getIID(), isInferred(), type);
        }

        
        public function getType() : RelationTypeImpl{
            return type;
        }

        
        public function addPlayer(RoleType roleType, Thing player) : void{
            execute(addPlayerReq(getIID(), protoRoleType(roleType), protoThing(player.getIID())));
        }

        
        public function removePlayer(RoleType roleType, Thing player) : void{
            execute(removePlayerReq(getIID(), protoRoleType(roleType), protoThing(player.getIID())));
        }

        
        public function getPlayers(RoleType... roleTypes) : Stream<ThingImpl>{
            return stream(getPlayersReq(getIID(), protoTypes(asList(roleTypes))))
                    .flatMap(rp -> rp.getRelationGetPlayersResPart().getThingsList().stream())
                    .map(ThingImpl::of);
        }

        
        public function List<ThingImpl>> getPlayersByRoleType() : Map<RoleTypeImpl,{
            Map<RoleTypeImpl, List<ThingImpl>> rolePlayerMap = new HashMap<>();
            stream(getPlayersByRoleTypeReq(getIID()))
                    .flatMap(rp -> rp.getRelationGetPlayersByRoleTypeResPart().getRoleTypesWithPlayersList().stream())
                    .forEach(rolePlayer -> {
                        RoleTypeImpl role = TypeImpl.of(rolePlayer.getRoleType()).asRoleType();
                        ThingImpl player = ThingImpl.of(rolePlayer.getPlayer());
                        if (rolePlayerMap.containsKey(role)) rolePlayerMap.get(role).add(player);
                        else rolePlayerMap.put(role, new ArrayList<>(Collections.singletonList(player)));
                    });
            return rolePlayerMap;
        }

        
        public function extends RoleType> getRelating() : Stream<?{
            return stream(getRelatingReq(getIID()))
                    .flatMap(rp -> rp.getRelationGetRelatingResPart().getRoleTypesList().stream())
                    .map(RoleTypeImpl::of);
        }

        
        public function RelationImpl.Remote asRelation() : final{
            return this;
        }
    }
}
