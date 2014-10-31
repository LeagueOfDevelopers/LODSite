<?php

namespace Lod\Db\Adapter\Driver\Mysqli;

use Lod\Db\Adapter\Driver\ConnectionInterface;

class Connection implements ConnectionInterface {

    private $config;
    private $is_connected = false;

    /** @var \mysqli */
    private $driver;

    function __construct($config) {
        $this->config = $config;
    }

    public function connect() {
        $mysqli = mysqli_init();
        if (!$mysqli) {
            return;
        }
        if (!$mysqli->options(MYSQLI_INIT_COMMAND, 'SET AUTOCOMMIT = 0')) {
            return;
        }
        if (!$mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 5)) {
            return;
        }
        if (!$mysqli->real_connect($this->config['host'], $this->config['user'], base64_decode($this->config['password']), $this->config['database'])) {
            return;
        }
        $this->is_connected = true;
        $mysqli->query('SET CHARACTER SET utf8');
        $mysqli->query('SET NAMES utf8');
        $this->driver = $mysqli;
    }

    public function isConnected() {
        return $this->is_connected;
    }

    public function getDriver() {
        return $this->driver;
    }

    public function getConfig() {
        return $this->config;
    }

    public function disconnect() {
        $this->driver->close();
    }
}