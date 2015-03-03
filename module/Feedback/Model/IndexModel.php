<?php

namespace Feedback\Model;

use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class IndexModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        $this->setData(array(
            'user' => $user
        ));

        return $this;
    }
}