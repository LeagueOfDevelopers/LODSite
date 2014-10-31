<?php

namespace User\Model;

use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\Logout;

class LogoutModel extends AbstractModel {

    public function main() {
        $logout = new Logout($this->getLodDb());
        $logout->logout();
    }
}