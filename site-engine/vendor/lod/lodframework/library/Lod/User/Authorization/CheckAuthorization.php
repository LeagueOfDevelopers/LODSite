<?php

namespace Lod\User\Authorization;

use Lod\Db\LodDatabase;

class CheckAuthorization implements CheckAuthorizationInterface {

    private $db;
    private $data;
    private $user_row;
    private $flag;

    /**
     * @param $db LodDatabase
     * @param $data array
     */
    function __construct(&$db, $data) {
        $this->db = $db;
        $this->data = $data;
        $this->flag = false;
    }

    public function check() {
        $result = $this->db->query("SELECT * FROM `users` WHERE `id` = ?i", 1);
        if ($result->num_rows) {
            $this->flag = true;
            $this->user_row = $result->fetch_array(MYSQL_ASSOC);
        }
    }

    public function getResult() {
        return $this->flag;
    }

    public function getUserRow() {
        return $this->user_row;
    }
}