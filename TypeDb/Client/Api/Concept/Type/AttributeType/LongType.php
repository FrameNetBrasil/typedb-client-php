<?php

namespace TypeDb\Client\Api\Concept\Type\AttributeType;

use TypeDb\Client\Api\TypeDBTransaction;
use TypeDb\Client\Api\Concept\Thing\Attribute;
use TypeDb\Client\Api\Concept\Type\AttributeType;
use TypeDb\Client\Api\Concept\Remote\Type\AttributeType\LongType as LongTypeRemote;


interface LongType extends AttributeType
{

    public function isLong(): bool;

    public function getType(): AttributeType;

    public function asRemote(TypeDBTransaction $transaction): LongTypeRemote;
}