<?php

namespace Admin\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\News\News;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class NewsModel extends AbstractModel {

    private $user;

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if ($user->getAccessLevel() != 10) {
            Application::toRoute('/');
            Application::stop();
        }

        $this->user = $user;

        $action = isset(Application::$request_variables['get']['act']) ? Application::$request_variables['get']['act'] : 'show';

        switch ($action) {
            case 'add':
                $this->addAction();
                break;
            case 'edit':
                $this->editAction();
                break;
            case 'show':
                $this->showNews();
                break;
            default:
                $this->showNews();
                break;
        }

        return $this;
    }

    private function addAction() {
        $user = $this->user;

        $this->setData(array(
            'user' => $user,
            'act' => 'add'
        ));
    }

    private function editAction() {
        $user = $this->user;

        $news_id = Application::$request_variables['get']['id'];

        if (empty($news_id)) {
            Application::toRoute('/');
            Application::stop();
        }

        $news = new News($this->getLodDb());
        $news_item = $news->getNewsItem($news_id);

        $this->setData(array(
            'user' => $user,
            'news_item' => $news_item,
            'act' => 'edit'
        ));
    }

    private function showNews() {
        $user = $this->user;
        $page = isset(Application::$request_variables['get']['page']) ? intval(Application::$request_variables['get']['page']) : 1;
        if ($page < 1) {
            $page = 1;
        }
        $count = 10;
        $offset = $count * ($page - 1);

        $news_object = new News($this->getLodDb());
        $news_list = $news_object->getNews($count, $offset);
        $pagination = $news_object->getPagination($page, News::$PER_PAGE);

        $this->setData(array(
            'user' => $user,
            'news' => array(
                'news_list' => $news_list,
                'pagination' => $pagination
            ),
            'act' => 'show'
        ));
    }
}