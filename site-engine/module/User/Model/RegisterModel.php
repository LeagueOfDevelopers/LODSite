<?php

namespace User\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class RegisterModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        if ($check_auth->getResult()) {
            //Application::toRoute('/');
            //Application::stop();
        }

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        $type = isset(Application::$request_variables['get']['success']) ? 1 : 0;
        $type = isset(Application::$request_variables['get']['confirmed']) ? 2 : $type;
        $this->setData(array(
            'user' => $user,
            'register.type' => $type
        ));

        return $this;
    }
}