<?php

namespace Admin\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;
use Lod\Project\Projects;

class ModifyProjectModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if ($user->getAccessLevel() < 8) {
            Application::toRoute('/');
            Application::stop();
        }
        $data =  Application::$request_variables['post'];
        $id = Application::$request_variables['get']['id'];
        $by = Application::$request_variables['get']['type'];
        $projects = new Projects($this->getLodDb());
        $projects->createProject($data, $by, $id);
        $this->setData(array(
            'user' => $user
        ));

        return $this;
    }
}