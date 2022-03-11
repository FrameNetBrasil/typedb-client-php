<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/logic.proto

namespace Typedb\Protocol\Explanation;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>typedb.protocol.Explanation.VarList</code>
 */
class VarList extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated string vars = 1;</code>
     */
    private $vars;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $vars
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Common\Logic::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated string vars = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getVars()
    {
        return $this->vars;
    }

    /**
     * Generated from protobuf field <code>repeated string vars = 1;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setVars($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->vars = $arr;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(VarList::class, \Typedb\Protocol\Explanation_VarList::class);

