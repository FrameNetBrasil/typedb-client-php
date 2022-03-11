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
use TypeDb\Client.api.concept.thing.Entity;
use TypeDb\Client.concept.type.EntityTypeImpl;
use TypeDb\common.collection.Bytes;
use Typedb\Protocol\ConceptProto;

class EntityImpl extends ThingImpl implements Entity{

    private  EntityTypeImpl type;

    EntityImpl(string iid, bool isInferred, EntityTypeImpl type) {
        super(iid, isInferred);
        this.type = type;
    }

    public function EntityImpl of(ConceptProto.Thing protoThing) : static{
        return new EntityImpl(Bytes.bytesToHexstring(protoThing.getIid().toByteArray()), protoThing.getInferred(), EntityTypeImpl.of(protoThing.getType()));
    }

    
    public function getType() : EntityTypeImpl{
        return type;
    }

    
    public function asRemote(TypeDBTransaction transaction) : EntityImpl.Remote{
        return new EntityImpl.Remote(transaction, getIID(), isInferred(), type);
    }

    
    public function EntityImpl asEntity() : final{
        return this;
    }

    public function class Remote extends ThingImpl.Remote implements Entity.Remote : static{

        private  EntityTypeImpl type;

        public function transaction, string iid, bool isInferred, EntityTypeImpl type) : Remote(TypeDBTransaction{
            super(transaction, iid, isInferred);
            this.type = type;
        }

        
        public function asRemote(TypeDBTransaction transaction) : EntityImpl.Remote{
            return new EntityImpl.Remote(transaction, getIID(), isInferred(), type);
        }

        
        public function getType() : EntityTypeImpl{
            return type;
        }

        
        public function EntityImpl.Remote asEntity() : final{
            return this;
        }
    }
}
