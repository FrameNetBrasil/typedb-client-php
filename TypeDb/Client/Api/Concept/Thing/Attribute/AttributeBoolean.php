<?php

namespace TypeDb\Client\Api\Concept\Thing;

interface AttributeBoolean extends Attribute {

    public function isBoolean(): bool;
    public function getType(): AttributeBoolean;


    public function asRemote(TypeDBTransaction $transaction): AttributeBooleanRemote;

    }