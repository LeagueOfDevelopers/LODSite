<?php

namespace Lod\User\Authorization;

class CheckAuthorization implements CheckAuthorizationInterface {

    private $db;
    private $data;

    function __construct(&$db, $data) {
        $this->db = $db;
        $this->data = $data;
    }

    public function check() {}
    public function getResult() {
        return false;
    }
}