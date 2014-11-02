<?php

namespace Admin\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\Authorization;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\Settings\UserCategories;
use Lod\User\User;

class SignInByUserModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if ($user->isAuth() && $user->getAccessLevel() == 10) {
            $data = Application::$request_variables['post'];

            $user_id = $data['id'];

            if (!$user_id || !is_numeric($user_id)) {
                $this->setData(array(
                    'result' => false
                ));
                return $this;
            }

            if ($user->getId() == $user_id) {
                $this->setData(array(
                    'result' => true
                ));
                return $this;
            }

            $cur_user = new Authorization($this->getLodDb());
            $cur_user->signInById($user_id);
            $result = $cur_user->getResult();

            $this->setData(array(
                'result' => $result
            ));
        } else {
            $this->setData(array(
                'result' => false
            ));
        }

        return $this;
    }
}