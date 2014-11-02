<?php

namespace Admin\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\News\News;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class DeleteNewsModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if ($user->isAuth() && $user->getAccessLevel() == 10) {
            $data = Application::$request_variables['post'];

            $news = new News($this->getLodDb());
            $news->deleteNewsItem($data['id']);

            $this->setData(array(
                'result' => true
            ));
        } else {
            $this->setData(array(
                'result' => false
            ));
        }

        return $this;
    }
}