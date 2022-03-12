<?php

namespace TypeDb\Client\Api\Concept\Type\AttributeType;

use TypeDb\Client\Api\Concept\Remote\Type\AttributeType;
use TypeDb\Client\Api\Concept\Type\Boolean;
use TypeDb\Client\Api\Concept\Type\AttributeType\BooleanType as BooleanTypeLocal;

interface DoubleType extends AttributeType, BooleanTypeLocal
{

    public function isDouble(): bool;

    public function getType(): AttributeType;

    public function asRemote(TypeDBTransaction $transaction): DoubleTypeemote;

Attribute.Double put(double value);



Attribute.Double get(double value);



Stream<? extends Attribute.Double> getInstances();



Stream<? extends AttributeType.Double> getSubtypes();

void setSupertype(AttributeType.Double doubleAttributeType);


}