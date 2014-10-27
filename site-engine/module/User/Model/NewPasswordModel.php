<?php

namespace User\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\User;

class NewPasswordModel extends AbstractModel {

    public function main() {
        $key = !empty(Application::$request_variables['get']['key']) ? Application::$request_variables['get']['key'] : false;
        if (!$key) {
            Application::toRoute('/');
            Application::stop();
        }

        $result = $this->getLodDb()->query("SELECT * FROM `users` WHERE `password_reset_key` = ?s", $key);
        $user = new User($this->getLodDb(), $result->fetch_array(MYSQL_ASSOC));

        if ($user->isEmpty()) {
            Application::toRoute('/');
            Application::stop();
        }

        $this->setData(array(
            'key' => $key
        ));


        return $this;
    }
}