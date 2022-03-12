<?php

namespace TypeDb\Client\Api\Concept\Type\AttributeType;

use Typedb\Protocol\AttributeType\ValueType as ProtoValueType;

class ValueType
{
    private bool $isWritable;
    private bool $isKeyable;
    private int $proto;

    public static function OBJECT()
    {
        $valueType = new ValueType();
        $valueType->isWritable = false;
        $valueType->isKeyable = false;
        $valueType->proto = ProtoValueType::value('OBJECT');
        return $valueType;
    }

    public static function BOOLEAN()
    {
        $valueType = new ValueType();
        $valueType->isWritable = true;
        $valueType->isKeyable = false;
        $valueType->proto = ProtoValueType::value('BOOLEAN');
        return $valueType;
    }

    public static function LONG()
    {
        $valueType = new ValueType();
        $valueType->isWritable = true;
        $valueType->isKeyable = true;
        $valueType->proto = ProtoValueType::value('LONG');
        return $valueType;
    }

    public static function DOUBLE()
    {
        $valueType = new ValueType();
        $valueType->isWritable = true;
        $valueType->isKeyable = false;
        $valueType->proto = ProtoValueType::value('DOUBLE');
        return $valueType;
    }

    public static function STRING()
    {
        $valueType = new ValueType();
        $valueType->isWritable = true;
        $valueType->isKeyable = true;
        $valueType->proto = ProtoValueType::value('STRING');
        return $valueType;
    }

    public static function DATETIME()
    {
        $valueType = new ValueType();
        $valueType->isWritable = true;
        $valueType->isKeyable = true;
        $valueType->proto = ProtoValueType::value('DATETIME');
        return $valueType;
    }

    public function isWritable() : bool{
        return $this->isWritable;
    }


    public function isKeyable() : bool{
        return $this->isKeyable;
    }


    public function proto(): int {
        return $this->proto;
    }


    /*
    enum ValueType {

        OBJECT(Object.class, false, false),
        BOOLEAN(Boolean.class, true, false),
        LONG(Long.class, true, true),
        DOUBLE(Double.class, true, false),
        STRING(string.class, true, true),
        DATETIME(LocalDateTime.class, true, true);

        private  Class<?> valueClass;
        private  bool isWritable;
        private  bool isKeyable;

        ValueType(Class<?> valueClass, bool isWritable, bool isKeyable) {
            this.valueClass = valueClass;
            this.isWritable = isWritable;
            this.isKeyable = isKeyable;
        }


        public function ValueType of(Class<?> valueClass) : static{
            for (ValueType t : ValueType.values()) {
                if (t.valueClass == valueClass) {
                    return t;
                }
            }
            throw new TypeDBClientException(BAD_VALUE_TYPE);
        }


        class valueClass()<?>{
            return valueClass;
        }


        public function isWritable() : bool{
            return isWritable;
        }


        public function isKeyable() : bool{
            return isKeyable;
        }


        public function proto() : ConceptProto.AttributeType.ValueType{
            switch (this) {
                case OBJECT:
                    return ConceptProto.AttributeType.ValueType.OBJECT;
                case BOOLEAN:
                    return ConceptProto.AttributeType.ValueType.BOOLEAN;
                case LONG:
                    return ConceptProto.AttributeType.ValueType.LONG;
                case DOUBLE:
                    return ConceptProto.AttributeType.ValueType.DOUBLE;
                case STRING:
                    return ConceptProto.AttributeType.ValueType.STRING;
                case DATETIME:
                    return ConceptProto.AttributeType.ValueType.DATETIME;
                default:
                    return ConceptProto.AttributeType.ValueType.UNRECOGNIZED;
            }
        }
    }
    */
}