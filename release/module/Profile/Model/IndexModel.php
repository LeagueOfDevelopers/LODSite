<?php

namespace Profile\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class IndexModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        $profile_user_id = isset(Application::$request_variables['get']['id']) ? Application::$request_variables['get']['id'] : false;
        if (!$profile_user_id) {
            if ($user->isAuth()) {
                $profile_user_id = $user->getId();
            } else {
                Application::toRoute('/');
                Application::stop();
            }
        }

        $profile_user = new User($this->getLodDb());
        $profile_user->allocateUserById($profile_user_id);

        if (!$profile_user->getObject()) {
            Application::toRoute('/');
            Application::stop();
        }

        if ($user->isAuth() && $profile_user_id != $user->getId()) {
            $profile_user->incrementViewCount();
        }

        $last_activity_users = $this->getLastActivityUsers();

        $this->setData(array(
            'user' => $user,
            'profile_user' => $profile_user,
            'last_activity_users' => $last_activity_users
        ));

        return $this;
    }

    private function getLastActivityUsers() {
        $db = $this->getLodDb();
        $result = $db->query(
            "SELECT * FROM `users`
            WHERE `confirmed` = '1' AND `admin_confirmed` = '1' AND `recent_activity_time` <> 0
            ORDER BY `recent_activity_time` DESC
            LIMIT 0, 10"
        );
        $users = array();
        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
            $entity = new User($db, $row);
            array_push($users, $entity);
        }
        return $users;
    }
}