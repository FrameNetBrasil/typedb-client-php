<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/concept.proto

namespace Typedb\Protocol\AttributeType\Put;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>typedb.protocol.AttributeType.Put.Res</code>
 */
class Res extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.typedb.protocol.Thing attribute = 1;</code>
     */
    protected $attribute = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Typedb\Protocol\Thing $attribute
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Common\Concept::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.typedb.protocol.Thing attribute = 1;</code>
     * @return \Typedb\Protocol\Thing|null
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    public function hasAttribute()
    {
        return isset($this->attribute);
    }

    public function clearAttribute()
    {
        unset($this->attribute);
    }

    /**
     * Generated from protobuf field <code>.typedb.protocol.Thing attribute = 1;</code>
     * @param \Typedb\Protocol\Thing $var
     * @return $this
     */
    public function setAttribute($var)
    {
        GPBUtil::checkMessage($var, \Typedb\Protocol\Thing::class);
        $this->attribute = $var;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Res::class, \Typedb\Protocol\AttributeType_Put_Res::class);

