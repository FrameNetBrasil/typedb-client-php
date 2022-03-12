<?php

namespace TypeDb\Client\Api\Concept\Thing\Attribute;

use TypeDb\Client\Api\TypeDBTransaction;
use TypeDb\Client\Api\Concept\Thing\Attribute;
use TypeDb\Client\Api\Concept\Type\AttributeType;
use TypeDb\Client\Api\Concept\Remote\Thing\Attribute\Double as DoubleRemote;


interface Double extends Attribute
{

    public function isDouble(): bool;

    public function getType(): AttributeType;

    public function asRemote(TypeDBTransaction $transaction): DoubleRemote;
}