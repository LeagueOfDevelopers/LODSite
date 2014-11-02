<?php

namespace Profile\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;
use Lod\User\Validator\FieldsValidator;

class SaveNewPasswordModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if ($user->isAuth()) {
            $data = Application::$request_variables['post'];

            $old_password  = $data['old_password'];
            $new_password = $data['new_password'];
            $new_password_confirm = $data['new_password_confirm'];

            $validator = new FieldsValidator();
            $result = true;

            $current_password_hash = $user->getPasswordHash();
            $old_password_hash = md5(md5($old_password.';'));
            if ($current_password_hash !== $old_password_hash) {
                $result = false;
            }

            if ($new_password !== $new_password_confirm || !$validator->isPasswordValid($new_password)) {
                $result = false;
            }

            if ($result) {
                $user->changePassword($new_password);
            }

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