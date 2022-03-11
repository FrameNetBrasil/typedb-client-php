<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/concept.proto

namespace Typedb\Protocol\ConceptManager\PutAttributeType;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>typedb.protocol.ConceptManager.PutAttributeType.Req</code>
 */
class Req extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string label = 1;</code>
     */
    protected $label = '';
    /**
     * Generated from protobuf field <code>.typedb.protocol.AttributeType.ValueType value_type = 2;</code>
     */
    protected $value_type = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $label
     *     @type int $value_type
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
     * Generated from protobuf field <code>.typedb.protocol.AttributeType.ValueType value_type = 2;</code>
     * @return int
     */
    public function getValueType()
    {
        return $this->value_type;
    }

    /**
     * Generated from protobuf field <code>.typedb.protocol.AttributeType.ValueType value_type = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setValueType($var)
    {
        GPBUtil::checkEnum($var, \Typedb\Protocol\AttributeType\ValueType::class);
        $this->value_type = $var;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Req::class, \Typedb\Protocol\ConceptManager_PutAttributeType_Req::class);

