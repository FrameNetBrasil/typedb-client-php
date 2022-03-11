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
use TypeDb\Client.common.Label;
use TypeDb\Client.common.exception.TypeDBClientException;
use TypeDb\Client.concept.ConceptImpl;
use TypeDb\Client.concept.thing.AttributeImpl;
use TypeDb\Client.concept.thing.EntityImpl;
use TypeDb\Client.concept.thing.RelationImpl;
use TypeDb\Client.concept.thing.ThingImpl;
use Typedb\Protocol\ConceptProto;
use Typedb\Protocol\TransactionProto;

import javax.annotation.Nullable;
import java.util.Collection;
import java.util.List;
import java.util.Objects;
import java.util.stream.Stream;

use TypeDb\Client.common.exception.ErrorMessage.Concept.BAD_ENCODING;
use TypeDb\Client.common.exception.ErrorMessage.Concept.INVALID_CONCEPT_CASTING;
use TypeDb\Client.common.exception.ErrorMessage.Concept.MISSING_LABEL;
use TypeDb\Client.common.exception.ErrorMessage.Concept.MISSING_TRANSACTION;
use TypeDb\Client.common.rpc.RequestBuilder.Type.deleteReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.getSubtypesReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.getSupertypeReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.getSupertypesReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.isAbstractReq;
use TypeDb\Client.common.rpc.RequestBuilder.Type.setLabelReq;
use TypeDb\Client.concept.type.RoleTypeImpl.protoRoleType;
use TypeDb\Client.concept.type.ThingTypeImpl.protoThingType;
use TypeDb\common.util.Objects.className;
import static java.util.stream.Collectors.toList;

public function class TypeImpl extends ConceptImpl implements Type : abstract{

    private  Label label;
    private  bool isRoot;
    private  int hash;

    TypeImpl(Label label, bool isRoot) {
        if (label == null) throw new TypeDBClientException(MISSING_LABEL);
        this.label = label;
        this.isRoot = isRoot;
        this.hash = Objects.hash(this.label);
    }

    public function TypeImpl of(ConceptProto.Type typeProto) : static{
        switch (typeProto.getEncoding()) {
            case ROLE_TYPE:
                return RoleTypeImpl.of(typeProto);
            case UNRECOGNIZED:
                throw new TypeDBClientException(BAD_ENCODING, typeProto.getEncoding());
            default:
                return ThingTypeImpl.of(typeProto);
        }
    }

    public function ConceptProto.Type.Encoding encoding(Type type) : static{
        if (type.isEntityType()) {
            return ConceptProto.Type.Encoding.ENTITY_TYPE;
        } else if (type.isRelationType()) {
            return ConceptProto.Type.Encoding.RELATION_TYPE;
        } else if (type.isAttributeType()) {
            return ConceptProto.Type.Encoding.ATTRIBUTE_TYPE;
        } else if (type.isRoleType()) {
            return ConceptProto.Type.Encoding.ROLE_TYPE;
        } else if (type.isThingType()) {
            return ConceptProto.Type.Encoding.THING_TYPE;
        } else {
            return ConceptProto.Type.Encoding.UNRECOGNIZED;
        }
    }

    public function List<ConceptProto.Type> protoTypes(Collection<? extends Type> types) : static{
        return types.stream().map(type -> {
            if (type.isThingType()) return protoThingType(type.asThingType());
            else return protoRoleType(type.asRoleType());
        }).collect(toList());
    }

    
    public function Label getLabel() : final{
        return label;
    }

    
    public function bool isRoot() : final{
        return isRoot;
    }

    
    public function asType() : TypeImpl{
        return this;
    }

    
    public function tostring() : string{
        return className(this.getClass()) + "[label: " + label + "]";
    }

    
    public function equals(Object o) : bool{
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        TypeImpl that = (TypeImpl) o;
        return this.label.equals(that.label);
    }

    
    public function hashCode() : int{
        return hash;
    }

    public function static class Remote extends ConceptImpl.Remote implements Type.Remote : abstract{

        final TypeDBTransaction.Extended transactionExt;
        private Label label;
        private  bool isRoot;
        private int hash;

        Remote(TypeDBTransaction transaction, Label label, bool isRoot) {
            if (transaction == null) throw new TypeDBClientException(MISSING_TRANSACTION);
            if (label == null) throw new TypeDBClientException(MISSING_LABEL);
            this.transactionExt = (TypeDBTransaction.Extended) transaction;
            this.label = label;
            this.isRoot = isRoot;
            this.hash = Objects.hash(this.transactionExt, label);
        }

        
        public function Label getLabel() : final{
            return label;
        }

        
        public function isRoot() : bool{
            return isRoot;
        }

        
        public function void setLabel(string newLabel) : final{
            execute(setLabelReq(getLabel(), newLabel));
            this.label = Label.of(label.scope().orElse(null), newLabel);
            this.hash = Objects.hash(transactionExt, this.label);
        }

        
        public function bool isAbstract() : final{
            return execute(isAbstractReq(getLabel())).getTypeIsAbstractRes().getAbstract();
        }

        
        public function asType() : TypeImpl.Remote{
            return this;
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

        
        public function asAttribute() : AttributeImpl.Remote<?>{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Attribute.class));
        }

        
        public function asRelation() : RelationImpl.Remote{
            throw new TypeDBClientException(INVALID_CONCEPT_CASTING, className(this.getClass()), className(Relation.class));
        }

        
        
        public function getSupertype() : TypeImpl{
            ConceptProto.Type.GetSupertype.Res res = execute(getSupertypeReq(getLabel())).getTypeGetSupertypeRes();
            switch (res.getResCase()) {
                case TYPE:
                    return TypeImpl.of(res.getType());
                default:
                case RES_NOT_SET:
                    return null;
            }
        }

        
        public function extends TypeImpl> getSupertypes() : Stream<?{
            return stream(getSupertypesReq(getLabel()))
                    .flatMap(rp -> rp.getTypeGetSupertypesResPart().getTypesList().stream())
                    .map(TypeImpl::of);
        }

        
        public function extends TypeImpl> getSubtypes() : Stream<?{
            return stream(getSubtypesReq(getLabel()))
                    .flatMap(rp -> rp.getTypeGetSubtypesResPart().getTypesList().stream())
                    .map(TypeImpl::of);
        }

        
        public function void delete() : final{
            execute(deleteReq(getLabel()));
        }

        final TypeDBTransaction tx() {
            return transactionExt;
        }

        protected ConceptProto.Type.Res execute(TransactionProto.Transaction.Req.Builder request) {
            return transactionExt.execute(request).getTypeRes();
        }

        protected Stream<ConceptProto.Type.ResPart> stream(TransactionProto.Transaction.Req.Builder request) {
            return transactionExt.stream(request).map(TransactionProto.Transaction.ResPart::getTypeResPart);
        }

        
        public function tostring() : string{
            return className(this.getClass()) + "[label: " + label.scopedName() + "]";
        }

        
        public function equals(Object o) : bool{
            if (this == o) return true;
            if (o == null || getClass() != o.getClass()) return false;

            TypeImpl.Remote that = (TypeImpl.Remote) o;
            return this.transactionExt.equals(that.transactionExt) &&
                    this.getLabel().equals(that.getLabel());
        }

        
        public function hashCode() : int{
            return hash;
        }
    }
}
