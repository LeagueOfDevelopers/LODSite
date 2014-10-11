<?php

namespace Lod\User\Authorization;

use Lod\Core\Application;
use Lod\Db\LodDatabase;

class CheckAuthorization implements CheckAuthorizationInterface {

    private $db;
    private $user_row;
    private $result = false;

    /**
     * @param $db LodDatabase
     * @param $data array
     */
    function __construct(&$db) {
        $this->db = $db;
    }

    public function check() {
        $key = !empty($_SESSION['loginkey']) ? $_SESSION['loginkey'] : !1;
        if (!$key) {
            $cookies = Application::$request_variables['cookie'];
            $cookie_key = !empty($cookies['key']) ? $cookies['key'] : !1;
            if (!$cookie_key) {
                $this->removeCookie('key');
            } else {
                $arr = explode('|', $cookie_key);
                $user_id = base64_decode($arr[0]);
                $access_key = base64_decode($arr[1]);
                if (!is_numeric($user_id)) {
                    $this->removeCookie('key');
                    return;
                }
                $user = $this->getUserById($user_id);
                if ($user['login_key'] !== $access_key) {
                    $this->removeCookie('key');
                    return;
                }
                $this->setSession('loginkey', $cookie_key);
                $this->user_row = $user;
                $this->result = true;
            }
        } else {
            $arr = explode('|', $key);
            $user_id = base64_decode($arr[0]);
            $this->user_row = $this->getUserById($user_id);
            $this->result = true;
        }
    }

    private function getUserById($user_id) {
        $result = $this->db->query("SELECT * FROM `users` WHERE `id` = ?i", $user_id);
        return $result->fetch_array(MYSQL_ASSOC);
    }

    private function setSession($key, $value) {
        $_SESSION[$key] = $value;
    }

    private function removeCookie($name) {
        setcookie($name, '', 0, "/");
    }

    public function getResult() {
        return $this->result;
    }

    public function getUserRow() {
        return $this->result ? $this->user_row : null;
    }
}