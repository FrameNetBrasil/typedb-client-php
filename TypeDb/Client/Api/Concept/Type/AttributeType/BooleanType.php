<?php

namespace TypeDb\Client\Api\Concept\Type\AttributeType;

use TypeDb\Client\Api\TypeDBTransaction;
use TypeDb\Client\Api\Concept\Type\AttributeType;
use TypeDb\Client\Api\Concept\Remote\Type\AttributeType\BooleanType as BooleanTypeRemote;

interface BooleanType extends AttributeType {

    public function isBoolean(): bool;
    public function getType(): AttributeType;
    public function asRemote(TypeDBTransaction $transaction): BooleanTypeRemote;

}