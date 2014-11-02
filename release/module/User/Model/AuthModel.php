<?php

namespace User\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\Authorization;

class AuthModel extends AbstractModel {

    public function main() {
        $auth = new Authorization($this->getLodDb(), Application::$request_variables['post']);
        $auth->signIn();
        $this->setData(array(
            'result' => $auth->getResult()
        ));

        return $this;
    }
}