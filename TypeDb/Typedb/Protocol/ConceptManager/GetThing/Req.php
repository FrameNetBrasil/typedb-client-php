<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/concept.proto

namespace Typedb\Protocol\ConceptManager\GetThing;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>typedb.protocol.ConceptManager.GetThing.Req</code>
 */
class Req extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>bytes iid = 1;</code>
     */
    protected $iid = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $iid
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Common\Concept::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>bytes iid = 1;</code>
     * @return string
     */
    public function getIid()
    {
        return $this->iid;
    }

    /**
     * Generated from protobuf field <code>bytes iid = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setIid($var)
    {
        GPBUtil::checkString($var, False);
        $this->iid = $var;

        return $this;
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Req::class, \Typedb\Protocol\ConceptManager_GetThing_Req::class);

