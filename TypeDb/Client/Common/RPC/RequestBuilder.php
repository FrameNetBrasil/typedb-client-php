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

namespace TypeDb\Client\Common\RPC;

import com.google.protobuf.Bytestring;
import com.vaticle.factory.tracing.client.FactoryTracingThreadStatic;
use TypeDb\Client.common.Label;
use Typedb\Protocol\ClusterDatabaseProto;
use Typedb\Protocol\ClusterServerProto;
use Typedb\Protocol\ClusterUserProto;
use Typedb\Protocol\ConceptProto;
use Typedb\Protocol\CoreDatabaseProto;
use Typedb\Protocol\LogicProto;
use Typedb\Protocol\OptionsProto;
use Typedb\Protocol\QueryProto;
use Typedb\Protocol\SessionProto;
use Typedb\Protocol\TransactionProto;

import java.time.LocalDateTime;
import java.time.ZoneOffset;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.UUID;

import static com.google.protobuf.Bytestring.copyFrom;
import static com.vaticle.factory.tracing.client.FactoryTracingThreadStatic.currentThreadTrace;
import static com.vaticle.factory.tracing.client.FactoryTracingThreadStatic.isTracingEnabled;
use TypeDb\Client.common.collection.Bytes.uuidToBytes;
use TypeDb\Client.common.rpc.RequestBuilder.Thing.bytestring;
use TypeDb\common.collection.Bytes.hexstringToBytes;
import static java.util.Collections.emptyMap;

class RequestBuilder{

    public function Map<string, string> tracingData() : static{
        if (isTracingEnabled()) {
            FactoryTracingThreadStatic.ThreadTrace threadTrace = currentThreadTrace();
            if (threadTrace == null) return emptyMap();
            if (threadTrace.getId() == null || threadTrace.getRootId() == null) return emptyMap();

            Map<string, string> metadata = new HashMap<>(2);
            metadata.put("traceParentId", threadTrace.getId().tostring());
            metadata.put("traceRootId", threadTrace.getRootId().tostring());
            return metadata;
        } else {
            return emptyMap();
        }
    }

    public function Bytestring UUIDAsBytestring(UUID uuid) : static{
        return copyFrom(uuidToBytes(uuid));
    }

    public function class Core : static{

        public function class DatabaseManager : static{

            public function CoreDatabaseProto.CoreDatabaseManager.Create.Req createReq(string name) : static{
                return CoreDatabaseProto.CoreDatabaseManager.Create.Req.newBuilder().setName(name).build();
            }

            public function CoreDatabaseProto.CoreDatabaseManager.Contains.Req containsReq(string name) : static{
                return CoreDatabaseProto.CoreDatabaseManager.Contains.Req.newBuilder().setName(name).build();
            }

            public function CoreDatabaseProto.CoreDatabaseManager.All.Req allReq() : static{
                return CoreDatabaseProto.CoreDatabaseManager.All.Req.getDefaultInstance();
            }
        }

        public function class Database : static{

            public function CoreDatabaseProto.CoreDatabase.Schema.Req schemaReq(string name) : static{
                return CoreDatabaseProto.CoreDatabase.Schema.Req.newBuilder().setName(name).build();
            }

            public function CoreDatabaseProto.CoreDatabase.Delete.Req deleteReq(string name) : static{
                return CoreDatabaseProto.CoreDatabase.Delete.Req.newBuilder().setName(name).build();
            }
        }
    }

    public function class Cluster : static{

        public function class ServerManager : static{

            public function ClusterServerProto.ServerManager.All.Req allReq() : static{
                return ClusterServerProto.ServerManager.All.Req.newBuilder().build();
            }
        }

        public function class UserManager : static{

            public function ClusterUserProto.ClusterUserManager.Contains.Req containsReq(string username) : static{
                return ClusterUserProto.ClusterUserManager.Contains.Req.newBuilder().setUsername(username).build();
            }

            public function ClusterUserProto.ClusterUserManager.Create.Req createReq(string username, string password) : static{
                return ClusterUserProto.ClusterUserManager.Create.Req.newBuilder().setUsername(username).setPassword(password).build();
            }

            public function ClusterUserProto.ClusterUserManager.All.Req allReq() : static{
                return ClusterUserProto.ClusterUserManager.All.Req.newBuilder().build();
            }
        }

        public function class User : static{

            public function ClusterUserProto.ClusterUser.Password.Req passwordReq(string username, string password) : static{
                return ClusterUserProto.ClusterUser.Password.Req.newBuilder().setUsername(username).setPassword(password).build();
            }

            public function ClusterUserProto.ClusterUser.Token.Req tokenReq(string username) : static{
                return ClusterUserProto.ClusterUser.Token.Req.newBuilder().setUsername(username).build();
            }

            public function ClusterUserProto.ClusterUser.Delete.Req deleteReq(string username) : static{
                return ClusterUserProto.ClusterUser.Delete.Req.newBuilder().setUsername(username).build();
            }
        }

        public function class DatabaseManager : static{

            public function ClusterDatabaseProto.ClusterDatabaseManager.Get.Req getReq(string name) : static{
                return ClusterDatabaseProto.ClusterDatabaseManager.Get.Req.newBuilder().setName(name).build();
            }

            public function ClusterDatabaseProto.ClusterDatabaseManager.All.Req allReq() : static{
                return ClusterDatabaseProto.ClusterDatabaseManager.All.Req.getDefaultInstance();
            }
        }

        public function class Database : static{

        }
    }

    public function class Session : static{

        public function SessionProto.Session.Open.Req openReq(
                string database, SessionProto.Session.Type type, OptionsProto.Options options) : static{
            return SessionProto.Session.Open.Req.newBuilder().setDatabase(database)
                    .setType(type).setOptions(options).build();
        }

        public function SessionProto.Session.Pulse.Req pulseReq(Bytestring sessionID) : static{
            return SessionProto.Session.Pulse.Req.newBuilder().setSessionId(sessionID).build();
        }

        public function SessionProto.Session.Close.Req closeReq(Bytestring sessionID) : static{
            return SessionProto.Session.Close.Req.newBuilder().setSessionId(sessionID).build();
        }
    }

    public function class Transaction : static{

        public function TransactionProto.Transaction.Client clientMsg(List<TransactionProto.Transaction.Req> reqs) : static{
            return TransactionProto.Transaction.Client.newBuilder().addAllReqs(reqs).build();
        }

        public function TransactionProto.Transaction.Req streamReq(UUID reqID) : static{
            return TransactionProto.Transaction.Req.newBuilder().setReqId(UUIDAsBytestring(reqID)).setStreamReq(
                    TransactionProto.Transaction.Stream.Req.getDefaultInstance()
            ).build();
        }

        public function TransactionProto.Transaction.Req.Builder openReq(
                Bytestring sessionID, TransactionProto.Transaction.Type type,
                OptionsProto.Options options, int networkLatencyMillis) : static{
            return TransactionProto.Transaction.Req.newBuilder().setOpenReq(
                    TransactionProto.Transaction.Open.Req.newBuilder().setSessionId(sessionID)
                            .setType(type).setOptions(options).setNetworkLatencyMillis(networkLatencyMillis)
            );
        }

        public function TransactionProto.Transaction.Req.Builder commitReq() : static{
            return TransactionProto.Transaction.Req.newBuilder().putAllMetadata(tracingData())
                    .setCommitReq(TransactionProto.Transaction.Commit.Req.getDefaultInstance());
        }

        public function TransactionProto.Transaction.Req.Builder rollbackReq() : static{
            return TransactionProto.Transaction.Req.newBuilder().putAllMetadata(tracingData())
                    .setRollbackReq(TransactionProto.Transaction.Rollback.Req.getDefaultInstance());
        }
    }

    public function class QueryManager : static{

        private static TransactionProto.Transaction.Req.Builder queryManagerReq(
                QueryProto.QueryManager.Req.Builder queryReq, OptionsProto.Options options) {
            return TransactionProto.Transaction.Req.newBuilder().setQueryManagerReq(queryReq.setOptions(options));
        }

        public function TransactionProto.Transaction.Req.Builder defineReq(string query, OptionsProto.Options options) : static{
            return queryManagerReq(QueryProto.QueryManager.Req.newBuilder().setDefineReq(
                    QueryProto.QueryManager.Define.Req.newBuilder().setQuery(query)
            ), options);
        }

        public function TransactionProto.Transaction.Req.Builder undefineReq(string query, OptionsProto.Options options) : static{
            return queryManagerReq(QueryProto.QueryManager.Req.newBuilder().setUndefineReq(
                    QueryProto.QueryManager.Undefine.Req.newBuilder().setQuery(query)
            ), options);
        }

        public function TransactionProto.Transaction.Req.Builder matchReq(string query, OptionsProto.Options options) : static{
            return queryManagerReq(QueryProto.QueryManager.Req.newBuilder().setMatchReq(
                    QueryProto.QueryManager.Match.Req.newBuilder().setQuery(query)
            ), options);
        }

        public function TransactionProto.Transaction.Req.Builder matchAggregateReq(
                string query, OptionsProto.Options options) : static{
            return queryManagerReq(QueryProto.QueryManager.Req.newBuilder().setMatchAggregateReq(
                    QueryProto.QueryManager.MatchAggregate.Req.newBuilder().setQuery(query)
            ), options);
        }

        public function TransactionProto.Transaction.Req.Builder matchGroupReq(
                string query, OptionsProto.Options options) : static{
            return queryManagerReq(QueryProto.QueryManager.Req.newBuilder().setMatchGroupReq(
                    QueryProto.QueryManager.MatchGroup.Req.newBuilder().setQuery(query)
            ), options);
        }

        public function TransactionProto.Transaction.Req.Builder matchGroupAggregateReq(
                string query, OptionsProto.Options options) : static{
            return queryManagerReq(QueryProto.QueryManager.Req.newBuilder().setMatchGroupAggregateReq(
                    QueryProto.QueryManager.MatchGroupAggregate.Req.newBuilder().setQuery(query)
            ), options);
        }

        public function TransactionProto.Transaction.Req.Builder insertReq(string query, OptionsProto.Options options) : static{
            return queryManagerReq(QueryProto.QueryManager.Req.newBuilder().setInsertReq(
                    QueryProto.QueryManager.Insert.Req.newBuilder().setQuery(query)
            ), options);
        }

        public function TransactionProto.Transaction.Req.Builder deleteReq(string query, OptionsProto.Options options) : static{
            return queryManagerReq(QueryProto.QueryManager.Req.newBuilder().setDeleteReq(
                    QueryProto.QueryManager.Delete.Req.newBuilder().setQuery(query)
            ), options);
        }

        public function TransactionProto.Transaction.Req.Builder updateReq(string query, OptionsProto.Options options) : static{
            return queryManagerReq(QueryProto.QueryManager.Req.newBuilder().setUpdateReq(
                    QueryProto.QueryManager.Update.Req.newBuilder().setQuery(query)
            ), options);
        }

        public function TransactionProto.Transaction.Req.Builder explainReq(long id, OptionsProto.Options options) : static{
            return queryManagerReq(QueryProto.QueryManager.Req.newBuilder().setExplainReq(
                    QueryProto.QueryManager.Explain.Req.newBuilder().setExplainableId(id)
            ), options);
        }
    }

    public function class ConceptManager : static{

        public function TransactionProto.Transaction.Req.Builder conceptManagerReq(
                ConceptProto.ConceptManager.Req.Builder req) : static{
            return TransactionProto.Transaction.Req.newBuilder().putAllMetadata(tracingData()).setConceptManagerReq(req);
        }

        public function TransactionProto.Transaction.Req.Builder putEntityTypeReq(string label) : static{
            return conceptManagerReq(ConceptProto.ConceptManager.Req.newBuilder().setPutEntityTypeReq(
                    ConceptProto.ConceptManager.PutEntityType.Req.newBuilder().setLabel(label))
            );
        }

        public function TransactionProto.Transaction.Req.Builder putRelationTypeReq(string label) : static{
            return conceptManagerReq(ConceptProto.ConceptManager.Req.newBuilder().setPutRelationTypeReq(
                    ConceptProto.ConceptManager.PutRelationType.Req.newBuilder().setLabel(label))
            );
        }

        public function TransactionProto.Transaction.Req.Builder putAttributeTypeReq(
                string label, ConceptProto.AttributeType.ValueType valueType) : static{
            return conceptManagerReq(ConceptProto.ConceptManager.Req.newBuilder().setPutAttributeTypeReq(
                    ConceptProto.ConceptManager.PutAttributeType.Req.newBuilder().setLabel(label).setValueType(valueType)
            ));
        }

        public function TransactionProto.Transaction.Req.Builder getThingTypeReq(string label) : static{
            return conceptManagerReq(ConceptProto.ConceptManager.Req.newBuilder().setGetThingTypeReq(
                    ConceptProto.ConceptManager.GetThingType.Req.newBuilder().setLabel(label)
            ));
        }

        public function TransactionProto.Transaction.Req.Builder getThingReq(string iid) : static{
            return conceptManagerReq(ConceptProto.ConceptManager.Req.newBuilder().setGetThingReq(
                    ConceptProto.ConceptManager.GetThing.Req.newBuilder().setIid(bytestring(iid))
            ));
        }
    }

    public function class LogicManager : static{

        private static TransactionProto.Transaction.Req.Builder logicManagerReq(
                LogicProto.LogicManager.Req.Builder logicReq) {
            return TransactionProto.Transaction.Req.newBuilder()
                    .putAllMetadata(tracingData()).setLogicManagerReq(logicReq);
        }

        public function TransactionProto.Transaction.Req.Builder putRuleReq(string label, string whenStr, string thenStr) : static{
            return logicManagerReq(LogicProto.LogicManager.Req.newBuilder().setPutRuleReq(
                    LogicProto.LogicManager.PutRule.Req.newBuilder()
                            .setLabel(label).setWhen(whenStr).setThen(thenStr)
            ));
        }

        public function TransactionProto.Transaction.Req.Builder getRuleReq(string label) : static{
            return logicManagerReq(LogicProto.LogicManager.Req.newBuilder().setGetRuleReq(
                    LogicProto.LogicManager.GetRule.Req.newBuilder().setLabel(label)
            ));
        }

        public function TransactionProto.Transaction.Req.Builder getRulesReq() : static{
            return logicManagerReq(LogicProto.LogicManager.Req.newBuilder().setGetRulesReq(
                    LogicProto.LogicManager.GetRules.Req.getDefaultInstance()
            ));
        }
    }

    public function class Type : static{

        private static TransactionProto.Transaction.Req.Builder typeReq(ConceptProto.Type.Req.Builder req) {
            return TransactionProto.Transaction.Req.newBuilder().setTypeReq(req);
        }

        private static ConceptProto.Type.Req.Builder newReqBuilder(Label label) {
            ConceptProto.Type.Req.Builder builder = ConceptProto.Type.Req.newBuilder().setLabel(label.name());
            if (label.scope().isPresent()) builder.setScope(label.scope().get());
            return builder;
        }

        public function TransactionProto.Transaction.Req.Builder isAbstractReq(Label label) : static{
            return typeReq(newReqBuilder(label).setTypeIsAbstractReq(
                    ConceptProto.Type.IsAbstract.Req.getDefaultInstance()
            ));
        }

        public function TransactionProto.Transaction.Req.Builder setLabelReq(Label label, string newLabel) : static{
            return typeReq(newReqBuilder(label).setTypeSetLabelReq(
                    ConceptProto.Type.SetLabel.Req.newBuilder().setLabel(newLabel)
            ));
        }

        public function TransactionProto.Transaction.Req.Builder getSupertypesReq(Label label) : static{
            return typeReq(newReqBuilder(label).setTypeGetSupertypesReq(
                    ConceptProto.Type.GetSupertypes.Req.getDefaultInstance()
            ));
        }

        public function TransactionProto.Transaction.Req.Builder getSubtypesReq(Label label) : static{
            return typeReq(newReqBuilder(label).setTypeGetSubtypesReq(
                    ConceptProto.Type.GetSubtypes.Req.getDefaultInstance()
            ));
        }

        public function TransactionProto.Transaction.Req.Builder getSupertypeReq(Label label) : static{
            return typeReq(newReqBuilder(label).setTypeGetSupertypeReq(
                    ConceptProto.Type.GetSupertype.Req.getDefaultInstance()
            ));
        }

        public function TransactionProto.Transaction.Req.Builder deleteReq(Label label) : static{
            return typeReq(newReqBuilder(label).setTypeDeleteReq(
                    ConceptProto.Type.Delete.Req.getDefaultInstance()
            ));
        }

        public function class RoleType : static{

            public function ConceptProto.Type protoRoleType(Label label, ConceptProto.Type.Encoding encoding) : static{
                assert label.scope().isPresent();
                return ConceptProto.Type.newBuilder().setScope(label.scope().get())
                        .setLabel(label.name()).setEncoding(encoding).build();
            }

            public function TransactionProto.Transaction.Req.Builder getRelationTypesReq(Label label) : static{
                return typeReq(newReqBuilder(label).setRoleTypeGetRelationTypesReq(
                        ConceptProto.RoleType.GetRelationTypes.Req.getDefaultInstance()
                ));
            }

            public function TransactionProto.Transaction.Req.Builder getPlayersReq(Label label) : static{
                return typeReq(newReqBuilder(label).setRoleTypeGetPlayersReq(
                        ConceptProto.RoleType.GetPlayers.Req.getDefaultInstance()
                ));
            }
        }

        public function class ThingType : static{

            public function ConceptProto.Type protoThingType(Label label, ConceptProto.Type.Encoding encoding) : static{
                return ConceptProto.Type.newBuilder().setLabel(label.name()).setEncoding(encoding).build();
            }

            public function TransactionProto.Transaction.Req.Builder setAbstractReq(Label label) : static{
                return typeReq(newReqBuilder(label).setThingTypeSetAbstractReq(
                        ConceptProto.ThingType.SetAbstract.Req.getDefaultInstance()
                ));
            }

            public function TransactionProto.Transaction.Req.Builder unsetAbstractReq(Label label) : static{
                return typeReq(newReqBuilder(label).setThingTypeUnsetAbstractReq(
                        ConceptProto.ThingType.UnsetAbstract.Req.getDefaultInstance()
                ));
            }

            public function TransactionProto.Transaction.Req.Builder setSupertypeReq(Label label, ConceptProto.Type supertype) : static{
                return typeReq(newReqBuilder(label).setTypeSetSupertypeReq(
                        ConceptProto.Type.SetSupertype.Req.newBuilder().setType(supertype)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder getPlaysReq(Label label) : static{
                return typeReq(newReqBuilder(label).setThingTypeGetPlaysReq(
                        ConceptProto.ThingType.GetPlays.Req.getDefaultInstance()
                ));
            }

            public function TransactionProto.Transaction.Req.Builder setPlaysReq(Label label, ConceptProto.Type roleType) : static{
                return typeReq(newReqBuilder(label).setThingTypeSetPlaysReq(
                        ConceptProto.ThingType.SetPlays.Req.newBuilder().setRole(roleType)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder setPlaysReq(
                    Label label, ConceptProto.Type roleType, ConceptProto.Type overriddenRoleType) : static{
                return typeReq(newReqBuilder(label).setThingTypeSetPlaysReq(
                        ConceptProto.ThingType.SetPlays.Req.newBuilder().setRole(roleType)
                                .setOverriddenRole(overriddenRoleType)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder unsetPlaysReq(Label label, ConceptProto.Type roleType) : static{
                return typeReq(newReqBuilder(label).setThingTypeUnsetPlaysReq(
                        ConceptProto.ThingType.UnsetPlays.Req.newBuilder().setRole(roleType)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder getOwnsReq(Label label, bool keysOnly) : static{
                return typeReq(newReqBuilder(label).setThingTypeGetOwnsReq(
                        ConceptProto.ThingType.GetOwns.Req.newBuilder().setKeysOnly(keysOnly)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder getOwnsReq(
                    Label label, ConceptProto.AttributeType.ValueType valueType, bool keysOnly) : static{
                return typeReq(newReqBuilder(label).setThingTypeGetOwnsReq(
                        ConceptProto.ThingType.GetOwns.Req.newBuilder().setKeysOnly(keysOnly)
                                .setValueType(valueType)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder setOwnsReq(
                    Label label, ConceptProto.Type attributeType, bool isKey) : static{
                return typeReq(newReqBuilder(label).setThingTypeSetOwnsReq(
                        ConceptProto.ThingType.SetOwns.Req.newBuilder()
                                .setAttributeType(attributeType)
                                .setIsKey(isKey)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder setOwnsReq(
                    Label label, ConceptProto.Type attributeType, ConceptProto.Type overriddenType, bool isKey) : static{
                return typeReq(newReqBuilder(label).setThingTypeSetOwnsReq(
                        ConceptProto.ThingType.SetOwns.Req.newBuilder()
                                .setAttributeType(attributeType)
                                .setOverriddenType(overriddenType)
                                .setIsKey(isKey)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder unsetOwnsReq(
                    Label label, ConceptProto.Type attributeType) : static{
                return typeReq(newReqBuilder(label).setThingTypeUnsetOwnsReq(
                        ConceptProto.ThingType.UnsetOwns.Req.newBuilder().setAttributeType(attributeType)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder getInstancesReq(Label label) : static{
                return typeReq(newReqBuilder(label).setThingTypeGetInstancesReq(
                        ConceptProto.ThingType.GetInstances.Req.getDefaultInstance()
                ));
            }
        }

        public function class EntityType : static{

            public function TransactionProto.Transaction.Req.Builder createReq(Label label) : static{
                return typeReq(newReqBuilder(label).setEntityTypeCreateReq(
                        ConceptProto.EntityType.Create.Req.getDefaultInstance()
                ));
            }
        }

        public function class RelationType : static{

            public function TransactionProto.Transaction.Req.Builder createReq(Label label) : static{
                return typeReq(newReqBuilder(label).setRelationTypeCreateReq(
                        ConceptProto.RelationType.Create.Req.getDefaultInstance()
                ));
            }

            public function TransactionProto.Transaction.Req.Builder getRelatesReq(Label label) : static{
                return typeReq(newReqBuilder(label).setRelationTypeGetRelatesReq(
                        ConceptProto.RelationType.GetRelates.Req.getDefaultInstance()
                ));
            }

            public function TransactionProto.Transaction.Req.Builder getRelatesReq(Label label, string roleLabel) : static{
                return typeReq(newReqBuilder(label).setRelationTypeGetRelatesForRoleLabelReq(
                        ConceptProto.RelationType.GetRelatesForRoleLabel.Req.newBuilder().setLabel(roleLabel)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder setRelatesReq(Label label, string roleLabel) : static{
                return typeReq(newReqBuilder(label).setRelationTypeSetRelatesReq(
                        ConceptProto.RelationType.SetRelates.Req.newBuilder().setLabel(roleLabel)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder setRelatesReq(
                    Label label, string roleLabel, string overriddenLabel) : static{
                return typeReq(newReqBuilder(label).setRelationTypeSetRelatesReq(
                        ConceptProto.RelationType.SetRelates.Req.newBuilder().setLabel(roleLabel)
                                .setOverriddenLabel(overriddenLabel)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder unsetRelatesReq(Label label, string roleLabel) : static{
                return typeReq(newReqBuilder(label).setRelationTypeUnsetRelatesReq(
                        ConceptProto.RelationType.UnsetRelates.Req.newBuilder().setLabel(roleLabel)
                ));
            }
        }

        public function class AttributeType : static{

            public function TransactionProto.Transaction.Req.Builder getOwnersReq(Label label, bool onlyKey) : static{
                return typeReq(newReqBuilder(label).setAttributeTypeGetOwnersReq(
                        ConceptProto.AttributeType.GetOwners.Req.newBuilder().setOnlyKey(onlyKey)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder putReq(Label label, ConceptProto.Attribute.Value value) : static{
                return typeReq(newReqBuilder(label).setAttributeTypePutReq(
                        ConceptProto.AttributeType.Put.Req.newBuilder().setValue(value)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder getReq(Label label, ConceptProto.Attribute.Value value) : static{
                return typeReq(newReqBuilder(label).setAttributeTypeGetReq(
                        ConceptProto.AttributeType.Get.Req.newBuilder().setValue(value)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder getRegexReq(Label label) : static{
                return typeReq(newReqBuilder(label).setAttributeTypeGetRegexReq(
                        ConceptProto.AttributeType.GetRegex.Req.getDefaultInstance()
                ));
            }

            public function TransactionProto.Transaction.Req.Builder setRegexReq(Label label, string regex) : static{
                return typeReq(newReqBuilder(label).setAttributeTypeSetRegexReq(
                        ConceptProto.AttributeType.SetRegex.Req.newBuilder().setRegex(regex)
                ));
            }
        }
    }

    public function class Thing : static{

        static Bytestring bytestring(string iid) {
            return Bytestring.copyFrom(hexstringToBytes(iid));
        }

        public function ConceptProto.Thing protoThing(string iid) : static{
            return ConceptProto.Thing.newBuilder().setIid(bytestring(iid)).build();
        }

        private static TransactionProto.Transaction.Req.Builder thingReq(ConceptProto.Thing.Req.Builder req) {
            return TransactionProto.Transaction.Req.newBuilder().setThingReq(req);
        }

        public function TransactionProto.Transaction.Req.Builder getHasReq(
                string iid, List<ConceptProto.Type> attributeTypes) : static{
            return thingReq(ConceptProto.Thing.Req.newBuilder().setIid(bytestring(iid)).setThingGetHasReq(
                    ConceptProto.Thing.GetHas.Req.newBuilder().addAllAttributeTypes(attributeTypes)
            ));
        }

        public function TransactionProto.Transaction.Req.Builder getHasReq(string iid, bool onlyKey) : static{
            return thingReq(ConceptProto.Thing.Req.newBuilder().setIid(bytestring(iid)).setThingGetHasReq(
                    ConceptProto.Thing.GetHas.Req.newBuilder().setKeysOnly(onlyKey)
            ));
        }

        public function TransactionProto.Transaction.Req.Builder setHasReq(string iid, ConceptProto.Thing attribute) : static{
            return thingReq(ConceptProto.Thing.Req.newBuilder().setIid(bytestring(iid)).setThingSetHasReq(
                    ConceptProto.Thing.SetHas.Req.newBuilder().setAttribute(attribute)
            ));
        }

        public function TransactionProto.Transaction.Req.Builder unsetHasReq(string iid, ConceptProto.Thing attribute) : static{
            return thingReq(ConceptProto.Thing.Req.newBuilder().setIid(bytestring(iid)).setThingUnsetHasReq(
                    ConceptProto.Thing.UnsetHas.Req.newBuilder().setAttribute(attribute)
            ));
        }

        public function TransactionProto.Transaction.Req.Builder getPlayingReq(string iid) : static{
            return thingReq(ConceptProto.Thing.Req.newBuilder().setIid(bytestring(iid)).setThingGetPlayingReq(
                    ConceptProto.Thing.GetPlaying.Req.getDefaultInstance()
            ));
        }

        public function TransactionProto.Transaction.Req.Builder getRelationsReq(
                string iid, List<ConceptProto.Type> roleTypes) : static{
            return thingReq(ConceptProto.Thing.Req.newBuilder().setIid(bytestring(iid)).setThingGetRelationsReq(
                    ConceptProto.Thing.GetRelations.Req.newBuilder().addAllRoleTypes(roleTypes)
            ));
        }

        public function TransactionProto.Transaction.Req.Builder deleteReq(string iid) : static{
            return thingReq(ConceptProto.Thing.Req.newBuilder().setIid(bytestring(iid)).setThingDeleteReq(
                    ConceptProto.Thing.Delete.Req.getDefaultInstance()
            ));
        }

        public function class Relation : static{

            public function TransactionProto.Transaction.Req.Builder addPlayerReq(
                    string iid, ConceptProto.Type roleType, ConceptProto.Thing player) : static{
                return thingReq(ConceptProto.Thing.Req.newBuilder().setIid(bytestring(iid)).setRelationAddPlayerReq(
                        ConceptProto.Relation.AddPlayer.Req.newBuilder().setRoleType(roleType).setPlayer(player)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder removePlayerReq(
                    string iid, ConceptProto.Type roleType, ConceptProto.Thing player) : static{
                return thingReq(ConceptProto.Thing.Req.newBuilder().setIid(bytestring(iid)).setRelationRemovePlayerReq(
                        ConceptProto.Relation.RemovePlayer.Req.newBuilder().setRoleType(roleType).setPlayer(player)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder getPlayersReq(
                    string iid, List<ConceptProto.Type> roleTypes) : static{
                return thingReq(ConceptProto.Thing.Req.newBuilder().setIid(bytestring(iid)).setRelationGetPlayersReq(
                        ConceptProto.Relation.GetPlayers.Req.newBuilder().addAllRoleTypes(roleTypes)
                ));
            }

            public function TransactionProto.Transaction.Req.Builder getPlayersByRoleTypeReq(string iid) : static{
                return thingReq(ConceptProto.Thing.Req.newBuilder().setIid(bytestring(iid)).setRelationGetPlayersByRoleTypeReq(
                        ConceptProto.Relation.GetPlayersByRoleType.Req.getDefaultInstance()
                ));
            }

            public function TransactionProto.Transaction.Req.Builder getRelatingReq(string iid) : static{
                return thingReq(ConceptProto.Thing.Req.newBuilder().setIid(bytestring(iid)).setRelationGetRelatingReq(
                        ConceptProto.Relation.GetRelating.Req.getDefaultInstance()
                ));
            }
        }

        public function class Attribute : static{

            public function TransactionProto.Transaction.Req.Builder getOwnersReq(string iid) : static{
                return thingReq(ConceptProto.Thing.Req.newBuilder().setIid(bytestring(iid)).setAttributeGetOwnersReq(
                        ConceptProto.Attribute.GetOwners.Req.getDefaultInstance()
                ));
            }

            public function TransactionProto.Transaction.Req.Builder getOwnersReq(string iid, ConceptProto.Type ownerType) : static{
                return thingReq(ConceptProto.Thing.Req.newBuilder().setIid(bytestring(iid)).setAttributeGetOwnersReq(
                        ConceptProto.Attribute.GetOwners.Req.newBuilder().setThingType(ownerType)
                ));
            }

            public function ConceptProto.Attribute.Value protoBooleanAttributeValue(bool value) : static{
                return ConceptProto.Attribute.Value.newBuilder().setBoolean(value).build();
            }

            public function ConceptProto.Attribute.Value protoLongAttributeValue(long value) : static{
                return ConceptProto.Attribute.Value.newBuilder().setLong(value).build();
            }

            public function ConceptProto.Attribute.Value protoDoubleAttributeValue(double value) : static{
                return ConceptProto.Attribute.Value.newBuilder().setDouble(value).build();
            }

            public function ConceptProto.Attribute.Value protostringAttributeValue(string value) : static{
                return ConceptProto.Attribute.Value.newBuilder().setstring(value).build();
            }

            public function ConceptProto.Attribute.Value protoDateTimeAttributeValue(LocalDateTime value) : static{
                long epochMillis = value.atZone(ZoneOffset.UTC).toInstant().toEpochMilli();
                return ConceptProto.Attribute.Value.newBuilder().setDateTime(epochMillis).build();
            }
        }
    }

    public function class Rule : static{

        private static TransactionProto.Transaction.Req.Builder ruleReq(LogicProto.Rule.Req.Builder req) {
            return TransactionProto.Transaction.Req.newBuilder().setRuleReq(req);
        }

        public function TransactionProto.Transaction.Req.Builder setLabelReq(string currentLabel, string newLabel) : static{
            return ruleReq(LogicProto.Rule.Req.newBuilder().setLabel(currentLabel).setRuleSetLabelReq(
                    LogicProto.Rule.SetLabel.Req.newBuilder().setLabel(newLabel)
            ));
        }

        public function TransactionProto.Transaction.Req.Builder deleteReq(string label) : static{
            return ruleReq(LogicProto.Rule.Req.newBuilder().setLabel(label).setRuleDeleteReq(
                    LogicProto.Rule.Delete.Req.getDefaultInstance()
            ));
        }
    }
}
