<?php

namespace TypeDb\Client\Api\Concept\Thing\Attribute;

use TypeDb\Client\Api\TypeDBTransaction;
use TypeDb\Client\Api\Concept\Thing\Attribute;
use TypeDb\Client\Api\Concept\Type\AttributeType;
use TypeDb\Client\Api\Concept\Remote\Thing\Attribute\Long as LongRemote;


interface Long extends Attribute
{

    public function isLong(): bool;

    public function getType(): AttributeType;

    public function asRemote(TypeDBTransaction $transaction): LongRemote;
}