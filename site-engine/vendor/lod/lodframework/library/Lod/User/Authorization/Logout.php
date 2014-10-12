<?php

namespace Lod\User\Authorization;

class Logout {

    private $db;

    /**
     * @param $db \Lod\Db\LodDatabase
     */
    function __construct(&$db) {
        $this->db = $db;
    }

    public function logout() {
        $key_manager = new KeyManager();
        list($user_id, $access_key) = $key_manager->getPair($_SESSION['loginkey']);

        $this->removeLoginKey($user_id);
        $this->removeSession('loginkey');
        $this->removeCookie('key');
    }

    private function removeLoginKey($user_id) {
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `login_key` = ?s WHERE `id` = ?i", '', $user_id);
        $this->db->query("COMMIT");
    }

    private function removeCookie($name) {
        setcookie($name, '', 0, '/');
    }

    private function removeSession($key) {
        unset($_SESSION[$key]);
    }
}