<?php

namespace Lod\User\Authorization;

class Authorization implements AuthorizationInterface {

    private $db;
    private $data;

    function __construct(&$db, $data) {
        $this->db = $db;
        $this->data = $data;
    }

    public function signIn() {}
    public function getResult() {}
}