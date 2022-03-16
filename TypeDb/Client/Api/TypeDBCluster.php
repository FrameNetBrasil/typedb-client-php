<?php

namespace TypeDb\Client\Api;

use TypeDb\Client\Api\User\UserManager;
use TypeDb\Client\Api\Database\DatabaseManagerCluster;

interface TypeDBCluster extends TypeDBClient
{

    public function users(): UserManager;

    public function databases(): DatabaseManagerCluster;

}