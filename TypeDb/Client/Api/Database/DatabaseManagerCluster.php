<?php

namespace TypeDb\Client\Api\Database;

interface DatabaseManagerCluster extends DatabaseManager {

    public function get(string $name): Database;
    public function all(): array;
}