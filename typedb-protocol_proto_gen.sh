#!/bin/bash
# Copyright 2015 gRPC authors.
#
# Licensed under the Apache License, Version 2.0 (the "License");
# you may not use this file except in compliance with the License.
# You may obtain a copy of the License at
#
#     http://www.apache.org/licenses/LICENSE-2.0
#
# Unless required by applicable law or agreed to in writing, software
# distributed under the License is distributed on an "AS IS" BASIS,
# WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
# See the License for the specific language governing permissions and
# limitations under the License.

set -e

cd /home/ematos/devel/php/grpc

# protoc and grpc_*_plugin binaries can be obtained by running
# $ bazel build @com_google_protobuf//:protoc //src/compiler:all
PROTOC=bazel-bin/external/com_google_protobuf/protoc
PLUGIN=protoc-gen-grpc=bazel-bin/src/compiler/grpc_php_plugin

$PROTOC  --proto_path=/home/ematos/devel/php/typedb-client-php/typedb-protocol \
       --php_out=/home/ematos/devel/php/typedb-client-php/TypeDb/ \
       --grpc_out=generate_server:/home/ematos/devel/php/typedb-client-php/TypeDb \
       --plugin=$PLUGIN /home/ematos/devel/php/typedb-client-php/typedb-protocol/common/*.proto

$PROTOC  --proto_path=/home/ematos/devel/php/typedb-client-php/typedb-protocol \
       --php_out=/home/ematos/devel/php/typedb-client-php/TypeDb/ \
       --grpc_out=generate_server:/home/ematos/devel/php/typedb-client-php/TypeDb \
       --plugin=$PLUGIN /home/ematos/devel/php/typedb-client-php/typedb-protocol/core/*.proto

$PROTOC  --proto_path=/home/ematos/devel/php/typedb-client-php/typedb-protocol \
       --php_out=/home/ematos/devel/php/typedb-client-php/TypeDb/ \
       --grpc_out=generate_server:/home/ematos/devel/php/typedb-client-php/TypeDb \
       --plugin=$PLUGIN /home/ematos/devel/php/typedb-client-php/typedb-protocol/cluster/*.proto
