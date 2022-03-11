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

namespace TypeDb\Client\Logic;

use TypeDb\Client\Api\Answer.ConceptMap;
use TypeDb\Client.api.logic.Explanation;
use TypeDb\Client.api.logic.Rule;
use TypeDb\Client.concept.answer.ConceptMapImpl;
use Typedb\Protocol\LogicProto;

import java.util.HashMap;
import java.util.HashSet;
import java.util.Map;
import java.util.Objects;
import java.util.Set;

class ExplanationImpl implements Explanation{

    private  Rule rule;
    private  Map<string, Set<string>> variableMapping;
    private  ConceptMap conclusion;
    private  ConceptMap condition;

    private ExplanationImpl(Rule rule, Map<string, Set<string>> variableMapping, ConceptMap conclusion, ConceptMap condition) {
        this.rule = rule;
        this.variableMapping = variableMapping;
        this.conclusion = conclusion;
        this.condition = condition;
    }

    public function Explanation of(LogicProto.Explanation explanation) : static{
        return new ExplanationImpl(
                RuleImpl.of(explanation.getRule()),
                of(explanation.getVarMappingMap()),
                ConceptMapImpl.of(explanation.getConclusion()),
                ConceptMapImpl.of(explanation.getCondition())
        );
    }

    private static Map<string, Set<string>> of(Map<string, LogicProto.Explanation.VarList> varMapping) {
        Map<string, Set<string>> mapping = new HashMap<>();
        varMapping.forEach((from, tos) -> mapping.put(from, new HashSet<>(tos.getVarsList())));
        return mapping;
    }

    
    public function rule() : Rule{
        return rule;
    }

    
    public function Set<string>> variableMapping() : Map<string,{
        return variableMapping;
    }

    
    public function conclusion() : ConceptMap{
        return conclusion;
    }

    
    public function condition() : ConceptMap{
        return condition;
    }

    
    public function equals(Object o) : bool{
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;
        final ExplanationImpl that = (ExplanationImpl) o;
        return rule.equals(that.rule) && variableMapping.equals(that.variableMapping) &&
                conclusion.equals(that.conclusion) && condition.equals(that.condition);
    }

    
    public function hashCode() : int{
        return Objects.hash(rule, variableMapping, conclusion, condition);
    }
}
