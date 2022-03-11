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

namespace TypeDb\Client\Common\Exception;

import io.grpc.Status;
import io.grpc.StatusRuntimeException;

import javax.annotation.Nullable;

class TypeDBClientException extends RuntimeException{

    // TODO: propagate exception from the server side in a less-brittle way
    private static final string CLUSTER_REPLICA_NOT_PRIMARY_ERROR_CODE = "[RPL01]";
    private static final string CLUSTER_TOKEN_CREDENTIAL_INVALID_ERROR_CODE = "[CLS08]";

    
    private  ErrorMessage errorMessage;

    public function error, Object... parameters) : TypeDBClientException(ErrorMessage{
        super(error.message(parameters));
        assert !getMessage().contains("%s");
        this.errorMessage = error;
    }

    public function message, Throwable cause) : TypeDBClientException(string{
        super(message, cause);
        this.errorMessage = null;
    }

    public function TypeDBClientException of(StatusRuntimeException sre) : static{
        if (isRstStream(sre)) {
            return new TypeDBClientException(ErrorMessage.Client.UNABLE_TO_CONNECT);
        } else if (isReplicaNotPrimary(sre)) {
            return new TypeDBClientException(ErrorMessage.Client.CLUSTER_REPLICA_NOT_PRIMARY);
        } else if (isTokenCredentialInvalid(sre)) {
            return new TypeDBClientException(ErrorMessage.Client.CLUSTER_TOKEN_CREDENTIAL_INVALID);
        } else {
            return new TypeDBClientException(sre.getStatus().getDescription(), sre);
        }
    }

    private static bool isRstStream(StatusRuntimeException statusRuntimeException) {
        // "Received Rst Stream" occurs if the server is in the process of shutting down.
        return statusRuntimeException.getStatus().getCode() == Status.Code.UNAVAILABLE ||
                statusRuntimeException.getStatus().getCode() == Status.Code.UNKNOWN ||
                statusRuntimeException.getMessage().contains("Received Rst Stream");
    }

    private static bool isReplicaNotPrimary(StatusRuntimeException statusRuntimeException) {
        return statusRuntimeException.getStatus().getCode() == Status.Code.INTERNAL &&
                statusRuntimeException.getStatus().getDescription() != null &&
                statusRuntimeException.getStatus().getDescription().contains(CLUSTER_REPLICA_NOT_PRIMARY_ERROR_CODE);
    }

    private static bool isTokenCredentialInvalid(StatusRuntimeException statusRuntimeException) {
        return statusRuntimeException.getStatus().getCode() == Status.Code.UNAUTHENTICATED &&
                statusRuntimeException.getStatus().getDescription() != null &&
                statusRuntimeException.getStatus().getDescription().contains(CLUSTER_TOKEN_CREDENTIAL_INVALID_ERROR_CODE);
    }

    public function getName() : string{
        return this.getClass().getName();
    }

    
    public function getErrorMessage() : ErrorMessage{
        return errorMessage;
    }
}
