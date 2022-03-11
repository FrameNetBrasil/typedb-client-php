<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/concept.proto

namespace Typedb\Protocol\EntityType\Create;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>typedb.protocol.EntityType.Create.Res</code>
 */
class Res extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.typedb.protocol.Thing entity = 1;</code>
     */
    protected $entity = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Typedb\Protocol\Thing $entity
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Common\Concept::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.typedb.protocol.Thing entity = 1;</code>
     * @return \Typedb\Protocol\Thing|null
     */
    public function getEntity()
    {
        return $this->entity;
    }

    public function hasEntity()
    {
        return isset($this->entity);
    }

    public function clearEntity()
    {
        unset($this->entity);
    }

    /**
     * Generated from protobuf field <code>.typedb.protocol.Thing entity = 1;</code>
     * @param \Typedb\Protocol\Thing $var
     * @return $this
     */
    public function setEntity($var)
    {
        GPBUtil::checkMessage($var, \Typedb\Protocol\Thing::class);
        $this->entity = $var;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Res::class, \Typedb\Protocol\EntityType_Create_Res::class);

