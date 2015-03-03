<?php

namespace Admin\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\Settings\UserCategories;
use Lod\User\User;

class SaveUserCategoryModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if ($user->isAuth() && $user->getAccessLevel() == 10) {
            $data = Application::$request_variables['post'];

            $user_id = $data['id'];
            $category = $data['category'];

            if (!$user_id || !$category) {
                $this->setData(array(
                    'result' => false
                ));
                return $this;
            }

            $cur_user = new User($this->getLodDb());
            $cur_user->allocateUserById($user_id);
            $result = !1;

            if (array_key_exists((string)$category, UserCategories::$categories)) {
                $cur_user->setAccessLevel($category);
                $result = !0;
            }

            $this->setData(array(
                'result' => $result
            ));
        } else {
            $this->setData(array(
                'result' => false
            ));
        }

        return $this;
    }
}