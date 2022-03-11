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

use TypeDb\Client\Api\Concept\Concept;
use TypeDb\Client.api.concept.thing.Attribute;
use TypeDb\Client.api.concept.thing.Entity;
use TypeDb\Client.api.concept.thing.Relation;
use TypeDb\Client.api.concept.thing.Thing;
use TypeDb\Client.api.concept.type.AttributeType;
use TypeDb\Client.api.concept.type.EntityType;
use TypeDb\Client.api.concept.type.RelationType;
use TypeDb\Client.api.concept.type.RoleType;
use TypeDb\Client.api.concept.type.ThingType;
use TypeDb\Client.api.concept.type.Type;
use TypeDb\Client.common.exception.TypeDBClientException;
use TypeDb\Client.concept.thing.AttributeImpl;
use TypeDb\Client.concept.thing.EntityImpl;
use TypeDb\Client.concept.thing.RelationImpl;
use TypeDb\Client.concept.thing.ThingImpl;
use TypeDb\Client.concept.type.AttributeTypeImpl;
use TypeDb\Client.concept.type.EntityTypeImpl;
use TypeDb\Client.concept.type.RelationTypeImpl;
use TypeDb\Client.concept.type.RoleTypeImpl;
use TypeDb\Client.concept.type.ThingTypeImpl;
use TypeDb\Client.concept.type.TypeImpl;
use Typedb\Protocol\ConceptProto;

use TypeDb\Client.common.exception.ErrorMessage.Concept.INVALID_CONCEPT_CASTING;
use TypeDb\common.util.Objects.className;

public function class ConceptImpl implements Concept : abstract{

    public function Concept of(ConceptProto.Concept protoConcept) : static{
        if (protoConcept.hasThing()) return ThingImpl.of(protoConcept.getThing());
        else return TypeImpl.of(protoConcept.getType());
    }

    
    public function bool isRemote() : final{
        return false;
    }

    
    public function asType() : TypeImpl{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Type.class));
    }

    
    public function asThingType() : ThingTypeImpl{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(ThingType.class));
    }

    
    public function asEntityType() : EntityTypeImpl{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(EntityType.class));
    }

    
    public function asAttributeType() : AttributeTypeImpl{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(AttributeType.class));
    }

    
    public function asRelationType() : RelationTypeImpl{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(RelationType.class));
    }

    
    public function asRoleType() : RoleTypeImpl{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(RoleType.class));
    }

    
    public function asThing() : ThingImpl{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Thing.class));
    }

    
    public function asEntity() : EntityImpl{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Entity.class));
    }

    
    public function asAttribute() : AttributeImpl<?>{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Attribute.class));
    }

    
    public function asRelation() : RelationImpl{
        throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Relation.class));
    }

    public function static class Remote implements Concept.Remote : abstract{

        
        public function bool isRemote() : final{
            return true;
        }

        
        public function asType() : TypeImpl.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Type.class));
        }

        
        public function asThingType() : ThingTypeImpl.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(ThingType.class));
        }

        
        public function asEntityType() : EntityTypeImpl.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(EntityType.class));
        }

        
        public function asRelationType() : RelationTypeImpl.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(RelationType.class));
        }

        
        public function asAttributeType() : AttributeTypeImpl.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(AttributeType.class));
        }

        
        public function asRoleType() : RoleTypeImpl.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(RoleType.class));
        }

        
        public function asThing() : ThingImpl.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Thing.class));
        }

        
        public function asEntity() : EntityImpl.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Entity.class));
        }

        
        public function asRelation() : RelationImpl.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Relation.class));
        }

        
        public function asAttribute() : AttributeImpl.Remote<?>{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Attribute.class));
        }
    }
}
