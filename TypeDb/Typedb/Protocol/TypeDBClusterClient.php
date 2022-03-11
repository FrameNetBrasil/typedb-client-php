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
class TypeDBClusterClient extends \Grpc\BaseStub {

    /**
     * @param string $hostname hostname
     * @param array $opts channel options
     * @param \Grpc\Channel $channel (optional) re-use channel object
     */
    public function __construct($hostname, $opts, $channel = null) {
        parent::__construct($hostname, $opts, $channel);
    }

    /**
     * Server Manager API
     * @param \Typedb\Protocol\ServerManager\All\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function servers_all(\Typedb\Protocol\ServerManager\All\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDBCluster/servers_all',
        $argument,
        ['\Typedb\Protocol\ServerManager\All\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * User Manager API
     * @param \Typedb\Protocol\ClusterUserManager\Contains\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function users_contains(\Typedb\Protocol\ClusterUserManager\Contains\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDBCluster/users_contains',
        $argument,
        ['\Typedb\Protocol\ClusterUserManager\Contains\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Typedb\Protocol\ClusterUserManager\Create\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function users_create(\Typedb\Protocol\ClusterUserManager\Create\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDBCluster/users_create',
        $argument,
        ['\Typedb\Protocol\ClusterUserManager\Create\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Typedb\Protocol\ClusterUserManager\All\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function users_all(\Typedb\Protocol\ClusterUserManager\All\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDBCluster/users_all',
        $argument,
        ['\Typedb\Protocol\ClusterUserManager\All\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * User API
     * @param \Typedb\Protocol\ClusterUser\Password\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function user_password(\Typedb\Protocol\ClusterUser\Password\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDBCluster/user_password',
        $argument,
        ['\Typedb\Protocol\ClusterUser\Password\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Typedb\Protocol\ClusterUser\Token\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function user_token(\Typedb\Protocol\ClusterUser\Token\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDBCluster/user_token',
        $argument,
        ['\Typedb\Protocol\ClusterUser\Token\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Typedb\Protocol\ClusterUser\Delete\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function user_delete(\Typedb\Protocol\ClusterUser\Delete\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDBCluster/user_delete',
        $argument,
        ['\Typedb\Protocol\ClusterUser\Delete\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * Database Manager API
     * @param \Typedb\Protocol\ClusterDatabaseManager\Get\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function databases_get(\Typedb\Protocol\ClusterDatabaseManager\Get\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDBCluster/databases_get',
        $argument,
        ['\Typedb\Protocol\ClusterDatabaseManager\Get\Res', 'decode'],
        $metadata, $options);
    }

    /**
     * @param \Typedb\Protocol\ClusterDatabaseManager\All\Req $argument input argument
     * @param array $metadata metadata
     * @param array $options call options
     * @return \Grpc\UnaryCall
     */
    public function databases_all(\Typedb\Protocol\ClusterDatabaseManager\All\Req $argument,
      $metadata = [], $options = []) {
        return $this->_simpleRequest('/typedb.protocol.TypeDBCluster/databases_all',
        $argument,
        ['\Typedb\Protocol\ClusterDatabaseManager\All\Res', 'decode'],
        $metadata, $options);
    }

}
