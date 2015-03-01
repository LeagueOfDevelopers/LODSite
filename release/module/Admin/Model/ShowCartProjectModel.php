<?php

namespace Admin\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\News\News;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;
use Lod\User\Users;
use Lod\Project\Project;
use Lod\Project\Projects;
use Lod\Orders\OrderItem;
class ShowCartProjectModel extends AbstractModel {

    private $user;

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if ($user->getAccessLevel() < 8) {
            Application::toRoute('/');
            Application::stop();
        }

        $id = Application::$request_variables['get']['id'];
        $project = new Project($this->getLodDb());
        $project->getProjectById($id);
        $UsProject = new Projects($this->getLodDb());
        $userOnProject = $UsProject->getUsersOnProject($id);
        $this->setData(array(
            'user' => $user,
            'project' => $project,
            'useronproject' => $userOnProject
        ));

        return $this;
    }
}
