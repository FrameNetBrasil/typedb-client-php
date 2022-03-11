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

use TypeDb\Client.api.TypeDBTransaction;
use TypeDb\Client.api.logic.Rule;
use TypeDb\Client.common.exception.TypeDBClientException;
use Typedb\Protocol\LogicProto;
import com.vaticle.typeql.lang.TypeQL;
import com.vaticle.typeql.lang.pattern.Conjunction;
import com.vaticle.typeql.lang.pattern.Pattern;
import com.vaticle.typeql.lang.pattern.variable.ThingVariable;

import java.util.Objects;

use TypeDb\Client.common.exception.ErrorMessage.Concept.MISSING_LABEL;
use TypeDb\Client.common.exception.ErrorMessage.Concept.MISSING_TRANSACTION;
use TypeDb\Client.common.rpc.RequestBuilder.Rule.deleteReq;
use TypeDb\Client.common.rpc.RequestBuilder.Rule.setLabelReq;
use TypeDb\common.util.Objects.className;

class RuleImpl implements Rule{

    private  string label;
    private  Conjunction<? extends Pattern> when;
    private  ThingVariable<?> then;
    private  int hash;

    RuleImpl(string label, Conjunction<? extends Pattern> when, ThingVariable<?> then) {
        if (label == null || label.isEmpty()) throw new TypeDBClientException(MISSING_LABEL);
        this.label = label;
        this.when = when;
        this.then = then;
        this.hash = Objects.hash(this.label);
    }

    public function RuleImpl of(LogicProto.Rule ruleProto) : static{
        return new RuleImpl(
                ruleProto.getLabel(),
                TypeQL.parsePattern(ruleProto.getWhen()).asConjunction(),
                TypeQL.parseVariable(ruleProto.getThen()).asThing()
        );
    }

    
    public function getLabel() : string{
        return label;
    }

    
    public function extends Pattern> getWhen() : Conjunction<?{
        return when;
    }

    
    public function getThen() : ThingVariable<?>{
        return then;
    }

    
    public function asRemote(TypeDBTransaction transaction) : RuleImpl.Remote{
        return new RuleImpl.Remote(transaction, getLabel(), getWhen(), getThen());
    }

    
    public function isRemote() : bool{
        return false;
    }

    
    public function tostring() : string{
        return className(this.getClass()) + "[label: " + label + "]";
    }

    
    public function equals(Object o) : bool{
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        RuleImpl that = (RuleImpl) o;
        return this.label.equals(that.label);
    }

    
    public function hashCode() : int{
        return hash;
    }

    public function class Remote implements Rule.Remote : static{

        final TypeDBTransaction.Extended transactionExt;
        private string label;
        private  Conjunction<? extends Pattern> when;
        private  ThingVariable<?> then;
        private  int hash;

        public function transaction, string label, Conjunction<? extends Pattern> when, ThingVariable<?> then) : Remote(TypeDBTransaction{
            if (transaction == null) throw new TypeDBClientException(MISSING_TRANSACTION);
            if (label == null || label.isEmpty()) throw new TypeDBClientException(MISSING_LABEL);
            this.transactionExt = (TypeDBTransaction.Extended) transaction;
            this.label = label;
            this.when = when;
            this.then = then;
            this.hash = Objects.hash(transaction, label);
        }

        
        public function getLabel() : string{
            return label;
        }

        
        public function extends Pattern> getWhen() : Conjunction<?{
            return when;
        }

        
        public function getThen() : ThingVariable<?>{
            return then;
        }

        
        public function setLabel(string newLabel) : void{
            transactionExt.execute(setLabelReq(label, newLabel));
            this.label = newLabel;
        }

        
        public function delete() : void{
            transactionExt.execute(deleteReq(label));
        }

        
        public function bool isDeleted() : final{
            return transactionExt.logic().getRule(label) != null;
        }

        
        public function asRemote(TypeDBTransaction transaction) : Remote{
            return new RuleImpl.Remote(transaction, getLabel(), getWhen(), getThen());
        }

        
        public function isRemote() : bool{
            return true;
        }

        
        public function tostring() : string{
            return className(this.getClass()) + "[label: " + label + "]";
        }

        
        public function equals(Object o) : bool{
            if (this == o) return true;
            if (o == null || getClass() != o.getClass()) return false;

            RuleImpl.Remote that = (RuleImpl.Remote) o;
            return this.transactionExt.equals(that.transactionExt) && this.label.equals(that.label);
        }

        
        public function hashCode() : int{
            return hash;
        }
    }
}
