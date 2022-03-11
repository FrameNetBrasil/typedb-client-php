<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/concept.proto

namespace Typedb\Protocol\AttributeType\Get;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>typedb.protocol.AttributeType.Get.Res</code>
 */
class Res extends \Google\Protobuf\Internal\Message
{
    protected $res;

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
        return $this->readOneof(1);
    }

    public function hasAttribute()
    {
        return $this->hasOneof(1);
    }

    /**
     * Generated from protobuf field <code>.typedb.protocol.Thing attribute = 1;</code>
     * @param \Typedb\Protocol\Thing $var
     * @return $this
     */
    public function setAttribute($var)
    {
        GPBUtil::checkMessage($var, \Typedb\Protocol\Thing::class);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getRes()
    {
        return $this->whichOneof("res");
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Res::class, \Typedb\Protocol\AttributeType_Get_Res::class);

