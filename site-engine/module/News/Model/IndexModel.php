<?php

namespace News\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\News\News;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class IndexModel extends AbstractModel {

    public function main() {
        $comment_id = isset(Application::$request_variables['get']['comment']) ? Application::$request_variables['get']['comment'] : false;
        $news_id = Application::$request_variables['get']['id'];
        if ($comment_id) {
            Application::toRoute("/news?id=$news_id#comment_$comment_id");
            Application::stop();
        }

        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        $news_id = isset(Application::$request_variables['get']['id']) ? intval(Application::$request_variables['get']['id']) : false;

        if (!$news_id) {
            Application::toRoute('/');
            Application::stop();
        }

        $news = new News($this->getLodDb());
        $news_item = $news->getNewsItem($news_id);

        if (!$news_item) {
            Application::toRoute('/');
            Application::stop();
        }

        if ($user->isAuth()) {
            $news_item->incrementCountViews();
        }

        $this->setData(array(
            'user' => $user,
            'news_item' => $news_item
        ));

        return $this;
    }
}