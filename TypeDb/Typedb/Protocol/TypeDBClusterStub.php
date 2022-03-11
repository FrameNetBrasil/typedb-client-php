<?php
// GENERATED CODE -- DO NOT EDIT!

// Original file comments:
//
// Copyright (C) 2021 Vaticle
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU Affero General Public License as
// published by the Free Software Foundation, either version 3 of the
// License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU Affero General Public License for more details.
//
// You should have received a copy of the GNU Affero General Public License
// along with this program.  If not, see <https://www.gnu.org/licenses/>.
//
//
namespace Typedb\Protocol;

/**
 */
class TypeDBClusterStub {

    /**
     * Server Manager API
     * @param \Typedb\Protocol\ServerManager\All\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\ServerManager\All\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function servers_all(
        \Typedb\Protocol\ServerManager\All\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\ServerManager\All\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * User Manager API
     * @param \Typedb\Protocol\ClusterUserManager\Contains\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\ClusterUserManager\Contains\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function users_contains(
        \Typedb\Protocol\ClusterUserManager\Contains\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\ClusterUserManager\Contains\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * @param \Typedb\Protocol\ClusterUserManager\Create\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\ClusterUserManager\Create\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function users_create(
        \Typedb\Protocol\ClusterUserManager\Create\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\ClusterUserManager\Create\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * @param \Typedb\Protocol\ClusterUserManager\All\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\ClusterUserManager\All\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function users_all(
        \Typedb\Protocol\ClusterUserManager\All\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\ClusterUserManager\All\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * User API
     * @param \Typedb\Protocol\ClusterUser\Password\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\ClusterUser\Password\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function user_password(
        \Typedb\Protocol\ClusterUser\Password\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\ClusterUser\Password\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * @param \Typedb\Protocol\ClusterUser\Token\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\ClusterUser\Token\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function user_token(
        \Typedb\Protocol\ClusterUser\Token\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\ClusterUser\Token\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * @param \Typedb\Protocol\ClusterUser\Delete\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\ClusterUser\Delete\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function user_delete(
        \Typedb\Protocol\ClusterUser\Delete\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\ClusterUser\Delete\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * Database Manager API
     * @param \Typedb\Protocol\ClusterDatabaseManager\Get\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\ClusterDatabaseManager\Get\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function databases_get(
        \Typedb\Protocol\ClusterDatabaseManager\Get\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\ClusterDatabaseManager\Get\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * @param \Typedb\Protocol\ClusterDatabaseManager\All\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\ClusterDatabaseManager\All\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function databases_all(
        \Typedb\Protocol\ClusterDatabaseManager\All\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\ClusterDatabaseManager\All\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * Get the method descriptors of the service for server registration
     *
     * @return array of \Grpc\MethodDescriptor for the service methods
     */
    public final function getMethodDescriptors(): array
    {
        return [
            '/typedb.protocol.TypeDBCluster/servers_all' => new \Grpc\MethodDescriptor(
                $this,
                'servers_all',
                '\Typedb\Protocol\ServerManager\All\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDBCluster/users_contains' => new \Grpc\MethodDescriptor(
                $this,
                'users_contains',
                '\Typedb\Protocol\ClusterUserManager\Contains\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDBCluster/users_create' => new \Grpc\MethodDescriptor(
                $this,
                'users_create',
                '\Typedb\Protocol\ClusterUserManager\Create\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDBCluster/users_all' => new \Grpc\MethodDescriptor(
                $this,
                'users_all',
                '\Typedb\Protocol\ClusterUserManager\All\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDBCluster/user_password' => new \Grpc\MethodDescriptor(
                $this,
                'user_password',
                '\Typedb\Protocol\ClusterUser\Password\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDBCluster/user_token' => new \Grpc\MethodDescriptor(
                $this,
                'user_token',
                '\Typedb\Protocol\ClusterUser\Token\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDBCluster/user_delete' => new \Grpc\MethodDescriptor(
                $this,
                'user_delete',
                '\Typedb\Protocol\ClusterUser\Delete\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDBCluster/databases_get' => new \Grpc\MethodDescriptor(
                $this,
                'databases_get',
                '\Typedb\Protocol\ClusterDatabaseManager\Get\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDBCluster/databases_all' => new \Grpc\MethodDescriptor(
                $this,
                'databases_all',
                '\Typedb\Protocol\ClusterDatabaseManager\All\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
        ];
    }

}
