<?php

require 'vendor/autoload.php';

use Typedb\Protocol\TypeDBClient;

$client = new Routeguide\RouteGuideClient('localhost:50051', [
    'credentials' => Grpc\ChannelCredentials::createInsecure(),
]);

function typeDBClientTest() {
    try {
        $client = new TypeDBClient("127.0.0.1:1729", []);
        $client->databases_create("typedb");
    } catch(Exception $e) {
        echo $e->getMessage();
    }
}

