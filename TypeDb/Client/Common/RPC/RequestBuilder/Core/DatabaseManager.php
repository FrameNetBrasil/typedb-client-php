<?php

namespace TypeDb\Client\Common\RPC\RequestBuilder\Core;

use Typedb\Protocol\CoreDatabaseManager\Create\Req as CreateReq;
use Typedb\Protocol\CoreDatabaseManager\Contains\Req as ContainsReq;
use Typedb\Protocol\CoreDatabaseManager\All\Req as AllReq;


class DatabaseManager
{
    public static function createReq(string $name): CreateReq
    {
        $req = new CreateReq();
        return $req->setName($name);
    }

    public static function containsReq(string $name): ContainsReq
    {
        $req = new ContainsReq();
        return $req->setName($name);
    }

    public static function allReq(): allReq
    {
        $req = new AllReq();
        return $req->getDefaultInstance();
    }

}