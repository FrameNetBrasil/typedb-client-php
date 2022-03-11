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
class TypeDBStub {

    /**
     * Database Manager API
     * @param \Typedb\Protocol\CoreDatabaseManager\Contains\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\CoreDatabaseManager\Contains\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function databases_contains(
        \Typedb\Protocol\CoreDatabaseManager\Contains\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\CoreDatabaseManager\Contains\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * @param \Typedb\Protocol\CoreDatabaseManager\Create\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\CoreDatabaseManager\Create\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function databases_create(
        \Typedb\Protocol\CoreDatabaseManager\Create\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\CoreDatabaseManager\Create\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * @param \Typedb\Protocol\CoreDatabaseManager\All\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\CoreDatabaseManager\All\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function databases_all(
        \Typedb\Protocol\CoreDatabaseManager\All\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\CoreDatabaseManager\All\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * Database API
     * @param \Typedb\Protocol\CoreDatabase\Schema\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\CoreDatabase\Schema\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function database_schema(
        \Typedb\Protocol\CoreDatabase\Schema\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\CoreDatabase\Schema\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * @param \Typedb\Protocol\CoreDatabase\Delete\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\CoreDatabase\Delete\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function database_delete(
        \Typedb\Protocol\CoreDatabase\Delete\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\CoreDatabase\Delete\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * Session API
     * @param \Typedb\Protocol\Session\Open\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\Session\Open\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function session_open(
        \Typedb\Protocol\Session\Open\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\Session\Open\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * @param \Typedb\Protocol\Session\Close\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\Session\Close\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function session_close(
        \Typedb\Protocol\Session\Close\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\Session\Close\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * Checks with the server that the session is still alive, and informs it that it should be kept alive.
     * @param \Typedb\Protocol\Session\Pulse\Req $request client request
     * @param \Grpc\ServerContext $context server request context
     * @return \Typedb\Protocol\Session\Pulse\Res for response data, null if if error occured
     *     initial metadata (if any) and status (if not ok) should be set to $context
     */
    public function session_pulse(
        \Typedb\Protocol\Session\Pulse\Req $request,
        \Grpc\ServerContext $context
    ): ?\Typedb\Protocol\Session\Pulse\Res {
        $context->setStatus(\Grpc\Status::unimplemented());
        return null;
    }

    /**
     * Transaction Streaming API
     * Opens a bi-directional stream representing a stateful transaction, streaming
     * requests and responses back-and-forth. The first transaction client message must
     * be {Transaction.Open.Req}. Closing the stream closes the transaction.
     * @param \Grpc\ServerCallReader $reader read client request data of \Typedb\Protocol\Transaction\Client
     * @param \Grpc\ServerCallWriter $writer write response data of \Typedb\Protocol\Transaction\Server
     * @param \Grpc\ServerContext $context server request context
     * @return void
     */
    public function transaction(
        \Grpc\ServerCallReader $reader,
        \Grpc\ServerCallWriter $writer,
        \Grpc\ServerContext $context
    ): void {
        $context->setStatus(\Grpc\Status::unimplemented());
        $writer->finish();
    }

    /**
     * Get the method descriptors of the service for server registration
     *
     * @return array of \Grpc\MethodDescriptor for the service methods
     */
    public final function getMethodDescriptors(): array
    {
        return [
            '/typedb.protocol.TypeDB/databases_contains' => new \Grpc\MethodDescriptor(
                $this,
                'databases_contains',
                '\Typedb\Protocol\CoreDatabaseManager\Contains\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDB/databases_create' => new \Grpc\MethodDescriptor(
                $this,
                'databases_create',
                '\Typedb\Protocol\CoreDatabaseManager\Create\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDB/databases_all' => new \Grpc\MethodDescriptor(
                $this,
                'databases_all',
                '\Typedb\Protocol\CoreDatabaseManager\All\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDB/database_schema' => new \Grpc\MethodDescriptor(
                $this,
                'database_schema',
                '\Typedb\Protocol\CoreDatabase\Schema\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDB/database_delete' => new \Grpc\MethodDescriptor(
                $this,
                'database_delete',
                '\Typedb\Protocol\CoreDatabase\Delete\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDB/session_open' => new \Grpc\MethodDescriptor(
                $this,
                'session_open',
                '\Typedb\Protocol\Session\Open\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDB/session_close' => new \Grpc\MethodDescriptor(
                $this,
                'session_close',
                '\Typedb\Protocol\Session\Close\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDB/session_pulse' => new \Grpc\MethodDescriptor(
                $this,
                'session_pulse',
                '\Typedb\Protocol\Session\Pulse\Req',
                \Grpc\MethodDescriptor::UNARY_CALL
            ),
            '/typedb.protocol.TypeDB/transaction' => new \Grpc\MethodDescriptor(
                $this,
                'transaction',
                '\Typedb\Protocol\Transaction\Client',
                \Grpc\MethodDescriptor::BIDI_STREAMING_CALL
            ),
        ];
    }

}
