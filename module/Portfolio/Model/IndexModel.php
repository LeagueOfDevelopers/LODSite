<?php

namespace Portfolio\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\News\Comments\Comments;
use Lod\News\News;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;
use Lod\User\Users;


class IndexModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();
        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        $page = isset(Application::$request_variables['get']['page']) ? intval(Application::$request_variables['get']['page']) : 1;
        if ($page < 1) {
            $page = 1;
        }
        $count = 10;
        $offset = $count * ($page - 1);

        $users_object = new Users($this->getLodDb());
        $users_list = $users_object->getUsersHaveProject($count, $offset);
        $pagination = $users_object->getPaginationForHaveProjects($page, 10);

        $new_users = $users_object->getNewUsers();

        $this->setData(array(
            'user' => $user,
            'users' => array(
                'users_list' => $users_list,
                'pagination' => $pagination,
                'new_users' => $new_users
            ),
            'act' => 'show'
        ));

        return $this;
    }
}