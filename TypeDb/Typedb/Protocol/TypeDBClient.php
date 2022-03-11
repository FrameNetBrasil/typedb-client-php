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
class TypeDBClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Database Manager API
     * @param \Typedb\Protocol\CoreDatabaseManager\Contains\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function databases_contains(\Typedb\Protocol\CoreDatabaseManager\Contains\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDB/databases_contains',
        $argument,
        ['\Typedb\Protocol\CoreDatabaseManager\Contains\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Typedb\Protocol\CoreDatabaseManager\Create\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function databases_create(\Typedb\Protocol\CoreDatabaseManager\Create\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDB/databases_create',
        $argument,
        ['\Typedb\Protocol\CoreDatabaseManager\Create\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Typedb\Protocol\CoreDatabaseManager\All\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function databases_all(\Typedb\Protocol\CoreDatabaseManager\All\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDB/databases_all',
        $argument,
        ['\Typedb\Protocol\CoreDatabaseManager\All\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * Database API
     * @param \Typedb\Protocol\CoreDatabase\Schema\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function database_schema(\Typedb\Protocol\CoreDatabase\Schema\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDB/database_schema',
        $argument,
        ['\Typedb\Protocol\CoreDatabase\Schema\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Typedb\Protocol\CoreDatabase\Delete\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function database_delete(\Typedb\Protocol\CoreDatabase\Delete\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDB/database_delete',
        $argument,
        ['\Typedb\Protocol\CoreDatabase\Delete\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * Session API
     * @param \Typedb\Protocol\Session\Open\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function session_open(\Typedb\Protocol\Session\Open\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDB/session_open',
        $argument,
        ['\Typedb\Protocol\Session\Open\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Typedb\Protocol\Session\Close\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function session_close(\Typedb\Protocol\Session\Close\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDB/session_close',
        $argument,
        ['\Typedb\Protocol\Session\Close\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * Checks with the server that the session is still alive, and informs it that it should be kept alive.
     * @param \Typedb\Protocol\Session\Pulse\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function session_pulse(\Typedb\Protocol\Session\Pulse\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDB/session_pulse',
        $argument,
        ['\Typedb\Protocol\Session\Pulse\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * Transaction Streaming API
     * Opens a bi-directional stream representing a stateful transaction, streaming
     * requests and responses back-and-forth. The first transaction client message must
     * be {Transaction.Open.Req}. Closing the stream closes the transaction.
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\BidiStreamingCall
     */
    public function transaction($metadata = [], $options = []) {
        return $this->_bidiRequest('/typedb.protocol.TypeDB/transaction',
        ['\Typedb\Protocol\Transaction\Server','decode'],
        $metadata, $options);
    }

}
