<?php

namespace User\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Validator\FieldsValidator;

class CheckLoginModel extends AbstractModel {

    public function main() {
        $nickname = Application::$request_variables['get']['login'];
        $correct = (new FieldsValidator())->isNickNameValid($nickname);
        $result = $this->getLodDb()->query("SELECT * FROM `users` WHERE `nickname` = ?s", $nickname);
        $this->setData(array(
            'valid' => !$result->num_rows && $correct
        ));

        return $this;
    }
}