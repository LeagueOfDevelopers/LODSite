<?php

namespace Lod\Db\Adapter\Driver;

interface ConnectionInterface {

    public function connect();
    public function isConnected();
    public function getDriver();
    public function getConfig();
    public function disconnect();
}