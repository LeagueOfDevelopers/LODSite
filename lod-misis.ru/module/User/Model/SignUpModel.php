<?php

namespace User\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Registration\Registration;

class SignUpModel extends AbstractModel {

    public function main() {
        $auth = new Registration($this->getLodDb(), Application::$request_variables['post']);
        $auth->signUp();
        $this->setData(array(
            'result' => $auth->getResult()
        ));

        return $this;
    }
}