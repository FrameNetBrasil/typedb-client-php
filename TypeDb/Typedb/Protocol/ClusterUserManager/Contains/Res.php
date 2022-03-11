<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: cluster/cluster_user.proto

namespace Typedb\Protocol\ClusterUserManager\Contains;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>typedb.protocol.ClusterUserManager.Contains.Res</code>
 */
class Res extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>bool contains = 1;</code>
     */
    protected $contains = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type bool $contains
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Cluster\ClusterUser::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>bool contains = 1;</code>
     * @return bool
     */
    public function getContains()
    {
        return $this->contains;
    }

    /**
     * Generated from protobuf field <code>bool contains = 1;</code>
     * @param bool $var
     * @return $this
     */
    public function setContains($var)
    {
        GPBUtil::checkBool($var);
        $this->contains = $var;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Res::class, \Typedb\Protocol\ClusterUserManager_Contains_Res::class);

