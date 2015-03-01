<?php

namespace Admin\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;
use Lod\Project\Projects;

class DelUserFromProjectModel extends AbstractModel {

    public function main() {
    	$check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if ($user->getAccessLevel() < 8) {
            Application::toRoute('/');
            Application::stop();
        }
        $id_u = Application::$request_variables['get']['id_u'];
        $id_p = Application::$request_variables['get']['id_p'];
        $userObj = new User($this->getLodDb());
        $userObj->allocateUserById($id_u);
        $userObj->delFromProject($id_p);
        $this->setData(array(
            'user' => $user,
            'id' => $id_p
        ));
        return $this;
    }
}