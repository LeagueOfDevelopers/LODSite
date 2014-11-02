<?php

namespace Profile\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class EditModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if (!$user->isAuth()) {
            Application::toRoute('/');
            Application::stop();
        }

        $this->setData(array(
            'user' => $user,
            'success_flag' => isset(Application::$request_variables['get']['success'])
        ));

        return $this;
    }
}