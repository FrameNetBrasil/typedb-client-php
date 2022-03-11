<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/concept.proto

namespace Typedb\Protocol\RelationType\SetRelates;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>typedb.protocol.RelationType.SetRelates.Req</code>
 */
class Req extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string label = 1;</code>
     */
    protected $label = '';
    protected $overridden;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $label
     *     @type string $overridden_label
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Common\Concept::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string label = 1;</code>
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Generated from protobuf field <code>string label = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setLabel($var)
    {
        GPBUtil::checkString($var, True);
        $this->label = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string overridden_label = 2;</code>
     * @return string
     */
    public function getOverriddenLabel()
    {
        return $this->readOneof(2);
    }

    public function hasOverriddenLabel()
    {
        return $this->hasOneof(2);
    }

    /**
     * Generated from protobuf field <code>string overridden_label = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setOverriddenLabel($var)
    {
        GPBUtil::checkString($var, True);
        $this->writeOneof(2, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getOverridden()
    {
        return $this->whichOneof("overridden");
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Req::class, \Typedb\Protocol\RelationType_SetRelates_Req::class);

