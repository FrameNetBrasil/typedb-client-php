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
use TypeDb\Client.api.logic.LogicManager;
use TypeDb\Client.api.logic.Rule;
use Typedb\Protocol\LogicProto;
use Typedb\Protocol\TransactionProto;
import com.vaticle.typeql.lang.pattern.Pattern;

import javax.annotation.Nullable;
import java.util.stream.Stream;

use TypeDb\Client.common.rpc.RequestBuilder.LogicManager.getRuleReq;
use TypeDb\Client.common.rpc.RequestBuilder.LogicManager.getRulesReq;
use TypeDb\Client.common.rpc.RequestBuilder.LogicManager.putRuleReq;

public function class LogicManagerImpl implements LogicManager : final{

    private  TypeDBTransaction.Extended transactionRPC;

    public function transactionRPC) : LogicManagerImpl(TypeDBTransaction.Extended{
        this.transactionRPC = transactionRPC;
    }

    
    
    public function getRule(string label) : Rule{
        LogicProto.LogicManager.GetRule.Res res = execute(getRuleReq(label)).getGetRuleRes();
        switch (res.getResCase()) {
            case RULE:
                return RuleImpl.of(res.getRule());
            default:
            case RES_NOT_SET:
                return null;
        }
    }

    
    public function getRules() : Stream<RuleImpl>{
        return stream(getRulesReq()).flatMap(res -> res.getGetRulesResPart().getRulesList().stream()).map(RuleImpl::of);
    }

    
    public function putRule(string label, Pattern when, Pattern then) : Rule{
        LogicProto.LogicManager.Res res = execute(putRuleReq(label, when.tostring(), then.tostring()));
        return RuleImpl.of(res.getPutRuleRes().getRule());
    }

    private LogicProto.LogicManager.Res execute(TransactionProto.Transaction.Req.Builder req) {
        return transactionRPC.execute(req).getLogicManagerRes();
    }

    private Stream<LogicProto.LogicManager.ResPart> stream(TransactionProto.Transaction.Req.Builder req) {
        return transactionRPC.stream(req).map(TransactionProto.Transaction.ResPart::getLogicManagerResPart);
    }
}
