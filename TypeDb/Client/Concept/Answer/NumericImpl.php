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
use TypeDb\Client.common.exception.TypeDBClientException;
use Typedb\Protocol\AnswerProto;

import javax.annotation.Nullable;

use TypeDb\Client.common.exception.ErrorMessage.Internal.ILLEGAL_CAST;
use TypeDb\Client.common.exception.ErrorMessage.Query.BAD_ANSWER_TYPE;

class NumericImpl implements Numeric{

    
    private  Long longValue;
    
    private  Double doubleValue;

    private NumericImpl( Long longValue,  Double doubleValue) {
        this.longValue = longValue;
        this.doubleValue = doubleValue;
    }

    public function NumericImpl of(AnswerProto.Numeric numeric) : static{
        switch (numeric.getValueCase()) {
            case LONG_VALUE:
                return NumericImpl.ofLong(numeric.getLongValue());
            case DOUBLE_VALUE:
                return NumericImpl.ofDouble(numeric.getDoubleValue());
            case NAN:
                return NumericImpl.ofNaN();
            default:
                throw new TypeDBClientException(BAD_ANSWER_TYPE, numeric.getValueCase());
        }
    }

    private static NumericImpl ofLong(long value) {
        return new NumericImpl(value, null);
    }

    private static NumericImpl ofDouble(double value) {
        return new NumericImpl(null, value);
    }

    private static NumericImpl ofNaN() {
        return new NumericImpl(null, null);
    }

    
    public function isLong() : bool{
        return longValue != null;
    }

    
    public function isDouble() : bool{
        return doubleValue != null;
    }

    
    public function isNaN() : bool{
        return !isLong() && !isDouble();
    }

    
    public function asLong() : long{
        if (isLong()) return longValue;
        else throw new TypeDBClientException(ILLEGAL_CAST, Long.class);
    }

    
    public function asDouble() : Double{
        if (isDouble()) return doubleValue;
        else throw new TypeDBClientException(ILLEGAL_CAST, Double.class);
    }

    
    public function asNumber() : Number{
        if (isLong()) return longValue;
        else if (isDouble()) return doubleValue;
        else throw new TypeDBClientException(ILLEGAL_CAST, Number.class);
    }
}
