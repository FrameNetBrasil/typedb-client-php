<?php

namespace TypeDb\Client\Api\Concept\Type\AttributeType;

use TypeDb\Client\Api\Concept\Remote\Type\AttributeType;
use TypeDb\Client\Api\Concept\Type\Boolean;
use TypeDb\Client\Api\Concept\Type\AttributeType\BooleanType as BooleanTypeLocal;


interface LongType extends AttributeType, BooleanTypeLocal
{

    public function isLong(): bool;

    public function getType(): AttributeType;

    public function asRemote(TypeDBTransaction $transaction): LongTypeRemote;

Attribute.Long put(long value);



Attribute.Long get(long value);



Stream<? extends Attribute.Long> getInstances();



Stream<? extends AttributeType.Long> getSubtypes();

void setSupertype(AttributeType.Long longAttributeType);
}