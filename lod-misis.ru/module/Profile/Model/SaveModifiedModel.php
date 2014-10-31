<?php

namespace Profile\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\Edit\ModifyAccount;
use Lod\User\User;

class SaveModifiedModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if ($user->isAuth()) {
            $data = Application::$request_variables['post'];

            $modifier = new ModifyAccount($this->getLodDb(), $data);
            $modifier
                ->setUserId($user->getId())
                ->save();

            $this->setData(array(
                'result' => $modifier->getResult()
            ));
        } else {
            $this->setData(array(
                'result' => false
            ));
        }

        return $this;
    }
}