<?php

namespace Admin\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\News\News;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;
use Lod\User\Users;

class UsersModel extends AbstractModel {

    private $user;

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        $this->user = $user;

        if ($user->getAccessLevel() != 10) {
            Application::toRoute('/');
            Application::stop();
        }

        $action = isset(Application::$request_variables['get']['act']) ? Application::$request_variables['get']['act'] : 'show';
        switch ($action) {
            case 'show':
                $this->showAction();
                break;
            case 'edit':
                $this->editAction();
                break;
            default:
                $this->showAction();
                break;
        }

        return $this;
    }

    private function showAction() {
        $user = $this->user;
        $page = isset(Application::$request_variables['get']['page']) ? intval(Application::$request_variables['get']['page']) : 1;
        if ($page < 1) {
            $page = 1;
        }
        $count = 20;
        $offset = $count * ($page - 1);

        $users_object = new Users($this->getLodDb());
        $users_list = $users_object->getUsers($count, $offset);
        $pagination = $users_object->getPagination($page, Users::$PER_PAGE);

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
    }

    private function editAction() {
        $user = $this->user;

        $user_id = isset(Application::$request_variables['get']['id']) ? intval(Application::$request_variables['get']['id']) : 0;

        if (!$user_id) {
            Application::toRoute('/adminium/users');
            Application::stop();
        }

        $users_object = new Users($this->getLodDb());
        $cur_user = $users_object->getUserItem($user_id);

        $this->setData(array(
            'user' => $user,
            'cur_user' => $cur_user,
            'act' => 'edit'
        ));
    }
}