<?php


namespace TypeDb\Client\Api\Concept\Remote\Type\AttributeType;

use TypeDb\Client\Api\Concept\Remote\Type\AttributeType;
use TypeDb\Client\Api\Concept\Type\Double;
use TypeDb\Client\Api\Concept\Type\AttributeType\DoubleType as DoubleTypeLocal;

interface DoubleType extends AttributeType, DoubleTypeLocal
{

    public function put(bool $value): Double;

    public function get(bool $value): Double;

    public function getInstances(); //stream

    public function getSubtypes(); //stream

    public function setSupertype(DoubleTypeLocal $boolAttributeType): void;


}