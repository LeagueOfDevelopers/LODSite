<?php

namespace Admin\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\Users;
use Lod\User\User;
use Lod\Project\Projects;

class CreateProjectByHandModel extends AbstractModel {

     public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if ($user->getAccessLevel() < 8) {
            Application::toRoute('/');
            Application::stop();
        }
        $usersFreeOdject = new Users($this->getLodDb());
        $usersFree = $usersFreeOdject->getFreeUsers();
            $this->setData(array(
                'user' => $user,
                'freeUsers' =>$usersFree
            ));

        return $this;
    }
}