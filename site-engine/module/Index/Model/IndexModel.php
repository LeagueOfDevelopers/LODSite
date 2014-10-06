<?php

namespace Index\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\User;

class IndexModel extends AbstractModel {

    public function main() {
        $user = new User($this->getLodDb());
        $user->allocateUserById(1);

        return $this;
    }
}