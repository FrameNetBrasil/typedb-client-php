<?php

namespace TypeDb\Client\Api\Concept\Remote\Type\AttributeType;

use TypeDb\Client\Api\Concept\Remote\Type\AttributeType;
use TypeDb\Client\Api\Concept\Type\Boolean;
use TypeDb\Client\Api\Concept\Type\AttributeType\BooleanType as BooleanTypeLocal;

interface BooleanType extends AttributeType, BooleanTypeLocal
{

    public function put(bool $value): Boolean;

    public function get(bool $value): Boolean;

    public function getInstances(); //stream

    public function getSubtypes(); //stream

    public function setSupertype(AttributeType $boolAttributeType): void;


}