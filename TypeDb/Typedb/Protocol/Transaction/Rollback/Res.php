<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/transaction.proto

namespace Typedb\Protocol\Transaction\Rollback;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>typedb.protocol.Transaction.Rollback.Res</code>
 */
class Res extends \Google\Protobuf\Internal\Message
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
        \GPBMetadata\Common\Transaction::initOnce();
        parent::__construct($data);
    }

}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Res::class, \Typedb\Protocol\Transaction_Rollback_Res::class);

