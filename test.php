<?php

require 'vendor/autoload.php';

use TypeDb\Client\Connection\Core\CoreClient;


function typeDBClientTest() {
    try {
        $client = new CoreClient("127.0.0.1:1729");
        $client->databases()->create("typedb");
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}

