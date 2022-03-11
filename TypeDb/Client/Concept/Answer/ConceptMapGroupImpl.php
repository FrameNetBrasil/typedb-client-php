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

namespace TypeDb\Client\Concept\Answer;

use TypeDb\Client\Api\Answer.ConceptMap;
use TypeDb\Client\Api\Answer.ConceptMapGroup;
use TypeDb\Client\Api\Concept\Concept;
use TypeDb\Client.concept.ConceptImpl;
use Typedb\Protocol\AnswerProto;

import java.util.List;
import java.util.Objects;

import static java.util.stream.Collectors.toList;

class ConceptMapGroupImpl implements ConceptMapGroup{
    private  Concept owner;
    private  List<ConceptMap> conceptMaps;
    private  int hash;

    public function owner, List<ConceptMap> conceptMaps) : ConceptMapGroupImpl(Concept{
        this.owner = owner;
        this.conceptMaps = conceptMaps;
        this.hash = Objects.hash(this.owner, this.conceptMaps);
    }

    public function ConceptMapGroup of(AnswerProto.ConceptMapGroup e) : static{
        Concept owner = ConceptImpl.of(e.getOwner());
        List<ConceptMap> conceptMaps = e.getConceptMapsList().stream().map(ConceptMapImpl::of).collect(toList());
        return new ConceptMapGroupImpl(owner, conceptMaps);
    }

    
    public function owner() : Concept{
        return this.owner;
    }

    
    public function conceptMaps() : List<ConceptMap>{
        return this.conceptMaps;
    }

    
    public function equals(Object obj) : bool{
        if (obj == this) return true;
        if (obj == null || getClass() != obj.getClass()) return false;
        ConceptMapGroupImpl a2 = (ConceptMapGroupImpl) obj;
        return this.owner.equals(a2.owner) &&
                this.conceptMaps.equals(a2.conceptMaps);
    }

    
    public function hashCode() : int{
        return hash;
    }
}
