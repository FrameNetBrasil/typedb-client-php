<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/session.proto

namespace Typedb\Protocol\Session;

use UnexpectedValueException;

/**
 * Protobuf type <code>typedb.protocol.Session.Type</code>
 */
class Type
{
    /**
     * Generated from protobuf enum <code>DATA = 0;</code>
     */
    const DATA = 0;
    /**
     * Generated from protobuf enum <code>SCHEMA = 1;</code>
     */
    const SCHEMA = 1;

    private static $valueToName = [
        self::DATA => 'DATA',
        self::SCHEMA => 'SCHEMA',
    ];

    public static function name($value)
    {
        if (!isset(self::$valueToName[$value])) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no name defined for value %s', __CLASS__, $value));
        }
        return self::$valueToName[$value];
    }


    public static function value($name)
    {
        $const = __CLASS__ . '::' . strtoupper($name);
        if (!defined($const)) {
            throw new UnexpectedValueException(sprintf(
                    'Enum %s has no value defined for name %s', __CLASS__, $name));
        }
        return constant($const);
    }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Type::class, \Typedb\Protocol\Session_Type::class);

