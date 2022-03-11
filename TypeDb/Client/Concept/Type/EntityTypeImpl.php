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
use TypeDb\Client.api.concept.type.EntityType;
use TypeDb\Client.common.Label;
use TypeDb\Client.concept.thing.EntityImpl;
use TypeDb\Client.concept.thing.ThingImpl;
use Typedb\Protocol\ConceptProto;

import java.util.stream.Stream;

use TypeDb\Client.common.rpc.RequestBuilder.Type.EntityType.createReq;

class EntityTypeImpl extends ThingTypeImpl implements EntityType{

    EntityTypeImpl(Label label, bool isRoot) {
        super(label, isRoot);
    }

    public function EntityTypeImpl of(ConceptProto.Type typeProto) : static{
        return new EntityTypeImpl(Label.of(typeProto.getLabel()), typeProto.getRoot());
    }

    
    public function asRemote(TypeDBTransaction transaction) : EntityTypeImpl.Remote{
        return new EntityTypeImpl.Remote(transaction, getLabel(), isRoot());
    }

    
    public function asEntityType() : EntityTypeImpl{
        return this;
    }

    public function class Remote extends ThingTypeImpl.Remote implements EntityType.Remote : static{

        Remote(TypeDBTransaction transaction, Label label, bool isRoot) {
            super(transaction, label, isRoot);
        }

        
        public function asRemote(TypeDBTransaction transaction) : EntityTypeImpl.Remote{
            return new EntityTypeImpl.Remote(transaction, getLabel(), isRoot());
        }

        
        public function EntityImpl create() : final{
            return EntityImpl.of(execute(createReq(getLabel())).getEntityTypeCreateRes().getEntity());
        }

        
        public function void setSupertype(EntityType entityType) : final{
            super.setSupertype(entityType);
        }

        
        public function Stream<EntityTypeImpl> getSubtypes() : final{
            return super.getSubtypes().map(ThingTypeImpl::asEntityType);
        }

        
        public function Stream<EntityImpl> getInstances() : final{
            return super.getInstances().map(ThingImpl::asEntity);
        }

        
        public function asEntityType() : EntityTypeImpl.Remote{
            return this;
        }
    }
}
