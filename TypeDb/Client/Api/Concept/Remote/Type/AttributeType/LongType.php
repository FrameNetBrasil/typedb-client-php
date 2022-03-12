<?php


namespace TypeDb\Client\Api\Concept\Remote\Type\AttributeType;

use TypeDb\Client\Api\Concept\Remote\Type\AttributeType;
use TypeDb\Client\Api\Concept\Type\Long;
use TypeDb\Client\Api\Concept\Type\AttributeType\LongType as LongTypeLocal;

interface LongType extends AttributeType, LongTypeLocal
{

    public function put(bool $value): Long;

    public function get(bool $value): Long;

    public function getInstances(); //stream

    public function getSubtypes(); //stream

    public function setSupertype(LongTypeLocal $boolAttributeType): void;


}