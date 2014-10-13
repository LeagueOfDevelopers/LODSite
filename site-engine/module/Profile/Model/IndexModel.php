<?php

namespace Profile\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class IndexModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        $profile_user_id = isset(Application::$request_variables['get']['id']) ? Application::$request_variables['get']['id'] : false;
        if (!$profile_user_id) {
            if ($user->isAuth()) {
                $profile_user_id = $user->getId();
            } else {
                Application::toRoute('/');
                Application::stop();
            }
        }

        $profile_user = new User($this->getLodDb());
        $profile_user->allocateUserById($profile_user_id);
        $profile_user->incrementViewCount();


        $this->setData(array(
            'user' => $user,
            'profile_user' => $profile_user
        ));

        return $this;
    }
}