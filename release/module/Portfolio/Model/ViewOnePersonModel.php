<?php

namespace Portfolio\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\News\Comments\Comments;
use Lod\News\News;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;
use Lod\User\Users;
use Lod\Project\Projects;

class ViewOnePersonModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();
        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);
                
        $id = (int)Application::$request_variables['get']['id'];
        $projectsObject = new Projects($this->getLodDb());
        $result = $projectsObject->getAllProjectsByUser($id);
        $userOn = new User($this->getLodDb());
        $userOn->allocateUserById($id);
        $this->setData(array(
            'user' => $user,
            'projects_list' => $result,
            'user_portfolio' => $userOn
        ));
        return $this;
    }
}