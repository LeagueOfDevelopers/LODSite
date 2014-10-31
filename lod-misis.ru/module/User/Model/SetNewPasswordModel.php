<?php

namespace User\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\User;
use Lod\User\Validator\FieldsValidator;

class SetNewPasswordModel extends AbstractModel {

    public function main() {
        $data = Application::$request_variables['post'];
        $key = $data['key'];
        $new_password = $data['new_password'];
        $new_password_confirm = $data['new_password_confirm'];

        $res = $this->getLodDb()->query("SELECT * FROM `users` WHERE `password_reset_key` = ?s", $key);
        $user = new User($this->getLodDb(), $res->fetch_array(MYSQL_ASSOC));

        if ($user->isEmpty()) {
            $this->setData(array(
                'result' => false
            ));
            return $this;
        }

        $validator = new FieldsValidator();
        $result = true;

        if ($new_password !== $new_password_confirm || !$validator->isPasswordValid($new_password)) {
            $result = false;
        }

        if ($result) {
            $user->changePassword($new_password);
            $user->setResetPasswordKey('');
        }

        $this->setData(array(
            'result' => $result
        ));

        return $this;
    }
}