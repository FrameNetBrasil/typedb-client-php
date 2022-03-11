<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: common/concept.proto

namespace Typedb\Protocol\Type;

use UnexpectedValueException;

/**
 * Protobuf type <code>typedb.protocol.Type.Encoding</code>
 */
class Encoding
{
    /**
     * Generated from protobuf enum <code>THING_TYPE = 0;</code>
     */
    const THING_TYPE = 0;
    /**
     * Generated from protobuf enum <code>ENTITY_TYPE = 1;</code>
     */
    const ENTITY_TYPE = 1;
    /**
     * Generated from protobuf enum <code>RELATION_TYPE = 2;</code>
     */
    const RELATION_TYPE = 2;
    /**
     * Generated from protobuf enum <code>ATTRIBUTE_TYPE = 3;</code>
     */
    const ATTRIBUTE_TYPE = 3;
    /**
     * Generated from protobuf enum <code>ROLE_TYPE = 4;</code>
     */
    const ROLE_TYPE = 4;

    private static $valueToName = [
        self::THING_TYPE => 'THING_TYPE',
        self::ENTITY_TYPE => 'ENTITY_TYPE',
        self::RELATION_TYPE => 'RELATION_TYPE',
        self::ATTRIBUTE_TYPE => 'ATTRIBUTE_TYPE',
        self::ROLE_TYPE => 'ROLE_TYPE',
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
class_alias(Encoding::class, \Typedb\Protocol\Type_Encoding::class);

