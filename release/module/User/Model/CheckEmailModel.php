<?php

namespace User\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Validator\FieldsValidator;

class CheckEmailModel extends AbstractModel {

    public function main() {
        $email = Application::$request_variables['get']['email'];
        $correct = (new FieldsValidator())->isEmailValid($email);
        $result = $this->getLodDb()->query("SELECT * FROM `users` WHERE `email` = ?s", $email);
        $this->setData(array(
            'valid' => !$result->num_rows && $correct
        ));

        return $this;
    }
}