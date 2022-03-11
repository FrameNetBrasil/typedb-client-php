<?php

namespace TypeDb\Client\Api\Concept\Remote\Thing\Attribute;

interface Double extends Attribute<java.lang.Double> {



default bool isDouble() {
            return true;
        }



        AttributeType.Double getType();



        Attribute.Double.Remote asRemote(TypeDBTransaction transaction);

        interface Remote extends Attribute.Double, Attribute.Remote<java.lang.Double> {
    }
    }