<?php

require 'vendor/autoload.php';

use TypeDb\Client\Connection\Core\CoreClient;


function typeDBClientTest() {
    try {
        $client = new CoreClient("127.0.0.1:1729");
        print_r("a\n");
        $client->databases()->create("typedb");
        print_r("b\n");
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}

typeDBClientTest();
