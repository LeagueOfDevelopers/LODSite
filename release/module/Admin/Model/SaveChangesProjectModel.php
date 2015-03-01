<?php

namespace Admin\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\News\News;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;
use Lod\Project\Project;
use Lod\Project\Projects;

class SaveChangesProjectModel extends AbstractModel {

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
        $data = Application::$request_variables['post'];
        $project = new Projects($this->getLodDb());    
        $project->editProject($data, $id);
        $this->setData(array(
                'id' => $id
            ));

        return $this;
    }
}