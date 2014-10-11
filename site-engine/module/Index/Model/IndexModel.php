<?php

namespace Index\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\Authorization;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\Authorization\Logout;
use Lod\User\User;

class IndexModel extends AbstractModel {

    public function main() {
        //$logout = new Logout($this->getLodDb());
        //$logout->logout();

        //$auth = new Authorization($this->getLodDb(), Application::$request_variables['get']);
        //$auth->signIn();

        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        $this->setData(array(
            'user' => $user
        ));

        return $this;
    }
}