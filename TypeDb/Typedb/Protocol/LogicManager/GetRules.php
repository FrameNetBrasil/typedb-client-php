<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/logic.proto

namespace Typedb\Protocol\LogicManager;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>typedb.protocol.LogicManager.GetRules</code>
 */
class GetRules extends \Google\Protobuf\Internal\Message
{

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Common\Logic::initOnce();
        parent::__construct($data);
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GetRules::class, \Typedb\Protocol\LogicManager_GetRules::class);

