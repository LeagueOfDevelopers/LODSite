<?php

namespace Lod\User\Registration;

class Registration implements RegistrationInterface {

    private $db;
    private $data;

    function __construct(&$db, $data) {
        $this->db = $db;
        $this->data = $data;
    }

    public function signUp() {}
    public function getResult() {}
}