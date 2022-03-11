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
use TypeDb\Client\Api\Concept\Concept;
use TypeDb\Client.common.exception.TypeDBClientException;
use TypeDb\Client.concept.ConceptImpl;
use TypeDb\common.collection.Pair;
use Typedb\Protocol\AnswerProto;

import java.util.Collection;
import java.util.Collections;
import java.util.HashMap;
import java.util.Map;
import java.util.Objects;
import java.util.stream.Collectors;

use TypeDb\Client.common.exception.ErrorMessage.Concept.NONEXISTENT_EXPLAINABLE_CONCEPT;
use TypeDb\Client.common.exception.ErrorMessage.Concept.NONEXISTENT_EXPLAINABLE_OWNERSHIP;
use TypeDb\Client.common.exception.ErrorMessage.Query.VARIABLE_DOES_NOT_EXIST;

class ConceptMapImpl implements ConceptMap{

    private  Map<string, Concept> map;
    private  Explainables explainables;

    public function Concept> map) : ConceptMapImpl(Map<string,{
        this(map, new ExplainablesImpl());
    }

    public function Concept> map, Explainables explainables) : ConceptMapImpl(Map<string,{
        this.map = Collections.unmodifiableMap(map);
        this.explainables = explainables;
    }

    public function ConceptMap of(AnswerProto.ConceptMap res) : static{
        Map<string, Concept> variableMap = new HashMap<>();
        res.getMapMap().forEach((resVar, resConcept) -> variableMap.put(resVar, ConceptImpl.of(resConcept)));
        return new ConceptMapImpl(Collections.unmodifiableMap(variableMap), of(res.getExplainables()));
    }

    private static Explainables of(AnswerProto.Explainables explainables) {
        Map<string, Explainable> relations = new HashMap<>();
        explainables.getRelationsMap().forEach((var, explainable) -> {
            relations.put(var, ExplainableImpl.of(explainable));
        });
        Map<string, Explainable> attributes = new HashMap<>();
        explainables.getAttributesMap().forEach((var, explainable) -> {
            attributes.put(var, ExplainableImpl.of(explainable));
        });
        Map<Pair<string, string>, Explainable> ownerships = new HashMap<>();
        explainables.getOwnershipsMap().forEach((var, ownedMap) -> {
            ownedMap.getOwnedMap().forEach((owned, explainable) -> {
                ownerships.put(new Pair<>(var, owned), ExplainableImpl.of(explainable));
            });
        });
        return new ExplainablesImpl(relations, attributes, ownerships);
    }

    
    public function Concept> map() : Map<string,{
        return map;
    }

    
    public function concepts() : Collection<Concept>{
        return map.values();
    }

    
    public function get(string variable) : Concept{
        Concept concept = map.get(variable);
        if (concept == null) throw new TypeDBClientException(VARIABLE_DOES_NOT_EXIST, variable);
        return concept;
    }

    
    public function explainables() : Explainables{
        return explainables;
    }

    
    public function tostring() : string{
        return map.entrySet().stream()
                .sorted(Map.Entry.comparingByKey())
                .map(e -> "[" + e.getKey() + "/" + e.getValue() + "]").collect(Collectors.joining());
    }

    
    public function equals(Object obj) : bool{
        if (obj == this) return true;
        if (obj == null || getClass() != obj.getClass()) return false;
        ConceptMapImpl a2 = (ConceptMapImpl) obj;
        return map.equals(a2.map);
    }

    
    public function hashCode() : int{
        return map.hashCode();
    }

    public function class ExplainablesImpl implements Explainables : static{

        Map<string, Explainable> explainableRelations;
        Map<string, Explainable> explainableAttributes;
        Map<Pair<string, string>, Explainable> explainableOwnerships;

        ExplainablesImpl() {
            this(new HashMap<>(), new HashMap<>(), new HashMap<>());
        }

        ExplainablesImpl(Map<string, Explainable> explainableRelations, Map<string, Explainable> explainableAttributes,
                         Map<Pair<string, string>, Explainable> explainableOwnerships) {
            this.explainableRelations = explainableRelations;
            this.explainableAttributes = explainableAttributes;
            this.explainableOwnerships = explainableOwnerships;
        }

        
        public function relation(string variable) : Explainable{
            Explainable explainable = explainableRelations.get(variable);
            if (explainable == null) throw new TypeDBClientException(NONEXISTENT_EXPLAINABLE_CONCEPT, variable);
            return explainable;
        }

        
        public function attribute(string variable) : Explainable{
            Explainable explainable = explainableAttributes.get(variable);
            if (explainable == null) throw new TypeDBClientException(NONEXISTENT_EXPLAINABLE_CONCEPT, variable);
            return explainable;
        }

        
        public function ownership(string owner, string attribute) : Explainable{
            Explainable explainable = explainableOwnerships.get(new Pair<>(owner, attribute));
            if (explainable == null)
                throw new TypeDBClientException(NONEXISTENT_EXPLAINABLE_OWNERSHIP, owner, attribute);
            return explainable;
        }

        
        public function Explainable> relations() : Map<string,{
            return this.explainableRelations;
        }

        
        public function Explainable> attributes() : Map<string,{
            return this.explainableAttributes;
        }

        
        public function string>, Explainable> ownerships() : Map<Pair<string,{
            return this.explainableOwnerships;
        }

        
        public function equals(Object o) : bool{
            if (this == o) return true;
            if (o == null || getClass() != o.getClass()) return false;
            ExplainablesImpl that = (ExplainablesImpl) o;
            return explainableRelations.equals(that.explainableRelations) &&
                    explainableAttributes.equals(that.explainableAttributes) &&
                    explainableOwnerships.equals(that.explainableOwnerships);
        }

        
        public function hashCode() : int{
            return Objects.hash(explainableRelations, explainableAttributes, explainableOwnerships);
        }

    }

    static class ExplainableImpl implements Explainable {

        private  string conjunction;
        private  long id;

        ExplainableImpl(string conjunction, long id) {
            this.conjunction = conjunction;
            this.id = id;
        }

        public function Explainable of(AnswerProto.Explainable explainable) : static{
            return new ExplainableImpl(explainable.getConjunction(), explainable.getId());
        }

        
        public function conjunction() : string{
            return conjunction;
        }

        
        public function id() : long{
            return id;
        }

        
        public function equals(final Object o) : bool{
            if (this == o) return true;
            if (o == null || getClass() != o.getClass()) return false;
            final ExplainableImpl that = (ExplainableImpl) o;
            return id == that.id;
        }

        
        public function hashCode() : int{
            return (int) id;
        }
    }
}
