<?php

namespace Lod\User\Authorization;

use Lod\Core\Application;
use Lod\User\Validator\FieldsValidator;

class Authorization implements AuthorizationInterface {

    private $db;
    private $data;

    private $result = false;
    private $infinity = true;

    /**
     * @param $db \Lod\Db\LodDatabase
     * @param $data
     */
    function __construct(&$db, $data) {
        $this->db = $db;
        $this->data = $data;
    }

    public function signIn() {
        $nickname = $this->data['login'];
        $password = $this->data['password'];
        $validator = new FieldsValidator();

        if ($validator->isNickNameValid($nickname) && $validator->isPasswordValid($password)) {
            $this->auth($nickname, $password);
        }
    }

    private function auth($nickname, $password) {
        $password_hash = md5(md5($password.';'));
        $result = $this->db->query("SELECT `id`,`password`,`login_key` FROM `users` WHERE `nickname` = ?s", (string)$nickname);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            if ($row['password'] === $password_hash) {
                $access_key = $this->generateKey();
                $this->setLoginKey($row['id'], $access_key);

                $key = base64_encode($row['id']).'|'.base64_encode($access_key);
                $this->setSession('loginkey', $key);

                if ($this->infinity) {
                    $this->setCookie('key', $key, time() + 14 * 24 * 60 * 60); /* 14 days */
                }
                $this->result = true;
            }
        }
    }

    private function generateKey() {
        return md5(mktime().rand(1, 10e5));
    }

    private function setLoginKey($user_id, $access_key) {
        $this->db->query("UPDATE `users` SET `login_key` = ?s WHERE `id` = ?i", $access_key, $user_id);
        $this->db->query("COMMIT");
    }

    private function setSession($key, $value) {
        $_SESSION[$key] = $value;
    }

    private function setCookie($name, $value, $remaining_time) {
        setcookie($name, $value, $remaining_time);
    }

    /**
     * @return bool
     */
    public function getResult() {
        return $this->result;
    }
}