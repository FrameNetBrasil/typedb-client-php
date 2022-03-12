<?php

namespace TypeDb\Client\Api\Concept\Thing\Attribute;

use TypeDb\Client\Api\TypeDBTransaction;
use TypeDb\Client\Api\Concept\Thing\Attribute;
use TypeDb\Client\Api\Concept\Type\AttributeType;
use TypeDb\Client\Api\Concept\Remote\Thing\Attribute\BooleanType as BooleanRemote;

interface Boolean extends Attribute {

    public function isBoolean(): bool;
    public function getType(): AttributeType;
    public function asRemote(TypeDBTransaction $transaction): BooleanRemote;

}