<?php

namespace Profile\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class ChangeStatusModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        $id = Application::$request_variables['get']['id'];
        $status = Application::$request_variables['get']['status'];

        if ($user->isAuth() && $user->getId() == $id) {
			$ourUser = new User($this->getLodDb());
			$ourUser->allocateUserById($id);
			$ourUser->changeStatus();
			$this->setData(array(
                'user' => $user,
                'id' => $ourUser->getId()
            ));
            
        } else {
			Application::toRoute('/profile?id='.$user->getId());
            Application::stop();
		}

        

        return $this;
    }
}