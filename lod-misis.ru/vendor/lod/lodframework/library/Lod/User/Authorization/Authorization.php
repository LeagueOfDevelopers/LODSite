<?php

namespace Lod\User\Authorization;

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
    function __construct(&$db, $data = array()) {
        $this->db = $db;
        $this->data = $data;
    }

    public function signIn() {
        $nickname = $this->data['login'];
        $password = $this->data['password'];
        $validator = new FieldsValidator();

        if ($validator->isNickNameValid($nickname) && $validator->isPasswordValid($password)) {
            $password = md5(md5($this->data['password'].';'));
            $this->auth($nickname, $password);
        }
    }

    public function signInById($id) {
        $user_row = $this->db->query("SELECT * FROM `users` WHERE `confirmed` = '1' AND `admin_confirmed` = '1' AND `id` = ?i", $id)->fetch_array(MYSQL_ASSOC);
        $this->auth($user_row['nickname'], $user_row['password']);
    }

    private function auth($nickname, $password) {
        $password_hash = $password;
        $result = $this->db->query("SELECT * FROM `users` WHERE `confirmed` = '1' AND `admin_confirmed` = '1' AND `nickname` = ?s", (string)$nickname);
        if ($result->num_rows) {
            $row = $result->fetch_assoc();
            if ($row['password'] === $password_hash) {
                $access_key = $this->generateKey();
                $this->setLoginKey($row['id'], $access_key);

                $key_manager = new KeyManager();
                $key = $key_manager->createKey($row['id'], $access_key);

                $this->setSession('loginkey', $key);

                if ($this->infinity) {
                    $this->setCookie('key', $key, time() + 14 * 24 * 60 * 60, '/'); /* 14 days */
                }
                $this->result = true;
            }
        }
    }

    private function generateKey() {
        return md5(mktime().rand(1, 10e8));
    }

    private function setLoginKey($user_id, $access_key) {
        $this->db->query("UPDATE `users` SET `login_key` = ?s, `last_logged_time` = ?i WHERE `id` = ?i", $access_key, time(), $user_id);
        $this->db->query("COMMIT");
    }

    private function setSession($key, $value) {
        $_SESSION[$key] = $value;
    }

    private function setCookie($name, $value, $remaining_time, $path) {
        setcookie($name, $value, $remaining_time, $path);
    }

    /**
     * @return bool
     */
    public function getResult() {
        return $this->result;
    }
}