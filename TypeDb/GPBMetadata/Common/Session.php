<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/session.proto

namespace GPBMetadata\Common;

class Session
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Common\Options::initOnce();
        $pool->internalAddGeneratedFile(
            '
�
common/session.prototypedb.protocol"�
Session�
Openo
Req
database (	+
type (2.typedb.protocol.Session.Type)
options (2.typedb.protocol.Options9
Res

session_id (
server_duration_millis ()
Close
Req

session_id (
Res8
Pulse
Req

session_id (
Res
alive ("
Type
DATA 

SCHEMAB+
com.vaticle.typedb.protocolBSessionProtobproto3'
        , true);

        static::$is_initialized = true;
    }
}

