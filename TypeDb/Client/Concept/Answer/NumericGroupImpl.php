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

use TypeDb\Client\Api\Answer.Numeric;
use TypeDb\Client\Api\Answer.NumericGroup;
use TypeDb\Client\Api\Concept\Concept;
use TypeDb\Client.concept.ConceptImpl;
use Typedb\Protocol\AnswerProto;

import java.util.Objects;

class NumericGroupImpl implements NumericGroup{

    private  Concept owner;
    private  Numeric numeric;
    private  int hash;

    private NumericGroupImpl(Concept owner, Numeric numeric) {
        this.owner = owner;
        this.numeric = numeric;
        this.hash = Objects.hash(this.owner, this.numeric);
    }

    public function NumericGroup of(AnswerProto.NumericGroup numericGroup) : static{
        return new NumericGroupImpl(ConceptImpl.of(numericGroup.getOwner()), NumericImpl.of(numericGroup.getNumber()));
    }

    
    public function owner() : Concept{
        return this.owner;
    }

    
    public function numeric() : Numeric{
        return this.numeric;
    }

    
    public function equals(Object obj) : bool{
        if (obj == this) return true;
        if (obj == null || getClass() != obj.getClass()) return false;
        NumericGroupImpl a2 = (NumericGroupImpl) obj;
        return this.owner.equals(a2.owner) &&
                this.numeric.equals(a2.numeric);
    }

    
    public function hashCode() : int{
        return hash;
    }
}
