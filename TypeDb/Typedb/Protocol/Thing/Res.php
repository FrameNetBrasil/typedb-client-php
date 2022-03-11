<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/concept.proto

namespace Typedb\Protocol\Thing;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>typedb.protocol.Thing.Res</code>
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
     *     @type \Typedb\Protocol\Thing\Delete\Res $thing_delete_res
     *           Thing method responses
     *     @type \Typedb\Protocol\Thing\GetType\Res $thing_get_type_res
     *     @type \Typedb\Protocol\Thing\SetHas\Res $thing_set_has_res
     *     @type \Typedb\Protocol\Thing\UnsetHas\Res $thing_unset_has_res
     *     @type \Typedb\Protocol\Relation\AddPlayer\Res $relation_add_player_res
     *           Relation method responses
     *     @type \Typedb\Protocol\Relation\RemovePlayer\Res $relation_remove_player_res
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Common\Concept::initOnce();
        parent::__construct($data);
    }

    /**
     * Thing method responses
     *
     * Generated from protobuf field <code>.typedb.protocol.Thing.Delete.Res thing_delete_res = 100;</code>
     * @return \Typedb\Protocol\Thing\Delete\Res|null
     */
    public function getThingDeleteRes()
    {
        return $this->readOneof(100);
    }

    public function hasThingDeleteRes()
    {
        return $this->hasOneof(100);
    }

    /**
     * Thing method responses
     *
     * Generated from protobuf field <code>.typedb.protocol.Thing.Delete.Res thing_delete_res = 100;</code>
     * @param \Typedb\Protocol\Thing\Delete\Res $var
     * @return $this
     */
    public function setThingDeleteRes($var)
    {
        GPBUtil::checkMessage($var, \Typedb\Protocol\Thing\Delete\Res::class);
        $this->writeOneof(100, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.typedb.protocol.Thing.GetType.Res thing_get_type_res = 101;</code>
     * @return \Typedb\Protocol\Thing\GetType\Res|null
     */
    public function getThingGetTypeRes()
    {
        return $this->readOneof(101);
    }

    public function hasThingGetTypeRes()
    {
        return $this->hasOneof(101);
    }

    /**
     * Generated from protobuf field <code>.typedb.protocol.Thing.GetType.Res thing_get_type_res = 101;</code>
     * @param \Typedb\Protocol\Thing\GetType\Res $var
     * @return $this
     */
    public function setThingGetTypeRes($var)
    {
        GPBUtil::checkMessage($var, \Typedb\Protocol\Thing\GetType\Res::class);
        $this->writeOneof(101, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.typedb.protocol.Thing.SetHas.Res thing_set_has_res = 102;</code>
     * @return \Typedb\Protocol\Thing\SetHas\Res|null
     */
    public function getThingSetHasRes()
    {
        return $this->readOneof(102);
    }

    public function hasThingSetHasRes()
    {
        return $this->hasOneof(102);
    }

    /**
     * Generated from protobuf field <code>.typedb.protocol.Thing.SetHas.Res thing_set_has_res = 102;</code>
     * @param \Typedb\Protocol\Thing\SetHas\Res $var
     * @return $this
     */
    public function setThingSetHasRes($var)
    {
        GPBUtil::checkMessage($var, \Typedb\Protocol\Thing\SetHas\Res::class);
        $this->writeOneof(102, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.typedb.protocol.Thing.UnsetHas.Res thing_unset_has_res = 103;</code>
     * @return \Typedb\Protocol\Thing\UnsetHas\Res|null
     */
    public function getThingUnsetHasRes()
    {
        return $this->readOneof(103);
    }

    public function hasThingUnsetHasRes()
    {
        return $this->hasOneof(103);
    }

    /**
     * Generated from protobuf field <code>.typedb.protocol.Thing.UnsetHas.Res thing_unset_has_res = 103;</code>
     * @param \Typedb\Protocol\Thing\UnsetHas\Res $var
     * @return $this
     */
    public function setThingUnsetHasRes($var)
    {
        GPBUtil::checkMessage($var, \Typedb\Protocol\Thing\UnsetHas\Res::class);
        $this->writeOneof(103, $var);

        return $this;
    }

    /**
     * Relation method responses
     *
     * Generated from protobuf field <code>.typedb.protocol.Relation.AddPlayer.Res relation_add_player_res = 200;</code>
     * @return \Typedb\Protocol\Relation\AddPlayer\Res|null
     */
    public function getRelationAddPlayerRes()
    {
        return $this->readOneof(200);
    }

    public function hasRelationAddPlayerRes()
    {
        return $this->hasOneof(200);
    }

    /**
     * Relation method responses
     *
     * Generated from protobuf field <code>.typedb.protocol.Relation.AddPlayer.Res relation_add_player_res = 200;</code>
     * @param \Typedb\Protocol\Relation\AddPlayer\Res $var
     * @return $this
     */
    public function setRelationAddPlayerRes($var)
    {
        GPBUtil::checkMessage($var, \Typedb\Protocol\Relation\AddPlayer\Res::class);
        $this->writeOneof(200, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.typedb.protocol.Relation.RemovePlayer.Res relation_remove_player_res = 201;</code>
     * @return \Typedb\Protocol\Relation\RemovePlayer\Res|null
     */
    public function getRelationRemovePlayerRes()
    {
        return $this->readOneof(201);
    }

    public function hasRelationRemovePlayerRes()
    {
        return $this->hasOneof(201);
    }

    /**
     * Generated from protobuf field <code>.typedb.protocol.Relation.RemovePlayer.Res relation_remove_player_res = 201;</code>
     * @param \Typedb\Protocol\Relation\RemovePlayer\Res $var
     * @return $this
     */
    public function setRelationRemovePlayerRes($var)
    {
        GPBUtil::checkMessage($var, \Typedb\Protocol\Relation\RemovePlayer\Res::class);
        $this->writeOneof(201, $var);

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
class_alias(Res::class, \Typedb\Protocol\Thing_Res::class);

