<?php

require 'vendor/autoload.php';

use TypeDb\Client\Connection\Core\CoreClient;


function typeDBClientTest()
{
    try {
        $client = new CoreClient("192.168.0.172:1729");
        $client->databases()->create("typedb");
        // client is open
        $session = $client->session("typedb", TypeDBSessionType . DATA);
        // session is open
        $session->close();
        // session is closed
        $client->close();
        // client is closed
    } catch (Exception $e) {
        print_r("\n*** Error \n");
        echo $e->getMessage();
    }
}

typeDBClientTest();
