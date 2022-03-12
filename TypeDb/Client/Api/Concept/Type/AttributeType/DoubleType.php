<?php

namespace TypeDb\Client\Api\Concept\Type\AttributeType;

use TypeDb\Client\Api\TypeDBTransaction;
use TypeDb\Client\Api\Concept\Thing\Attribute;
use TypeDb\Client\Api\Concept\Type\AttributeType;
use TypeDb\Client\Api\Concept\Remote\Type\AttributeType\DoubleType as DoubleTypeRemote;


interface DoubleType extends AttributeType
{

    public function isDouble(): bool;

    public function getType(): AttributeType;

    public function asRemote(TypeDBTransaction $transaction): DoubleTypeemote;
}