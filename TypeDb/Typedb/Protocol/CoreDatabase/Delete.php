<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: core/core_database.proto

namespace Typedb\Protocol\CoreDatabase;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>typedb.protocol.CoreDatabase.Delete</code>
 */
class Delete extends \Google\Protobuf\Internal\Message
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
        \GPBMetadata\Core\CoreDatabase::initOnce();
        parent::__construct($data);
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Delete::class, \Typedb\Protocol\CoreDatabase_Delete::class);

