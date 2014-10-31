<?php

namespace Lod\Db\Adapter;

use Lod\Db\Adapter\Driver\Mysqli\Connection;

class MysqlAdapter implements AdapterInterface {

    private $connection;

    function __construct($db_config) {
        $this->connection = new Connection($db_config);
    }

    public function getConnection() {
        if ($this->connection->isConnected()) {
            return $this->connection;
        }
        return !1;
    }

    public function connect() {
        $this->connection->connect();
    }
}