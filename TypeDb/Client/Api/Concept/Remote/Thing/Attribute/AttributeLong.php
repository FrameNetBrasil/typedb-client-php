<?php

namespace TypeDb\Client\Api\Concept\Remote\Thing\Attribute;

interface Long extends Attribute<java.lang.Long> {



default bool isLong() {
            return true;
        }



        AttributeType.Long getType();



        Attribute.Long.Remote asRemote(TypeDBTransaction transaction);

        interface Remote extends Attribute.Long, Attribute.Remote<java.lang.Long> {
    }
    }