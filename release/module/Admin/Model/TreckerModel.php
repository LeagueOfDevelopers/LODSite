<?php

namespace Admin\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\Settings\UserCategories;
use Lod\User\User;
use Lod\Project\Projects;
use Lod\User\Users;
class TreckerModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if ($user->getAccessLevel() < 8) {
            Application::toRoute('/');
            Application::stop();
        }

        $projectsObject = new Projects($this->getLodDb());
        $result = $projectsObject->getAllProjects();
        $array_list = array();
        foreach($result as $res){
        $listOfUsers = $projectsObject->getUsersOnProject($res->getId());
        array_push($array_list, $listOfUsers);
    }   
        $usersObj = new Users($this->getLodDb());
        $arFreeUsers = $usersObj->getFreeUsers();
        $this->setData(array(
            'user' => $user,
            'projects_list' => $result,
            'userOnProject' => $array_list,
            'freeUsers' => $arFreeUsers
        ));
        return $this;
    }
    
}