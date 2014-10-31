<?php

namespace Index\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\News\Comments\Comments;
use Lod\News\News;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

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
        $count = 5;
        $offset = $count * ($page - 1);

        $news_object = new News($this->getLodDb());
        $news_list = $news_object->getNews($count, $offset);
        $pagination = $news_object->getPagination($page, $count);

        $comments = new Comments($this->getLodDb());
        $comments_list = $comments->getAllComments(3);

        $this->setData(array(
            'user' => $user,
            'news' => $news_list,
            'pagination' => $pagination,
            'comments_list' => $comments_list
        ));

        return $this;
    }
}