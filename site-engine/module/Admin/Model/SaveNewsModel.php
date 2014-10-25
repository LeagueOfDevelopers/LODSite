<?php

namespace Admin\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\News\News;
use Lod\News\NewsItem;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class SaveNewsModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if ($user->isAuth() && $user->getAccessLevel() == 10) {
            $data = Application::$request_variables['post'];

            $news = new News($this->getLodDb());
            $news->addNewsItem($data, $user->getId());

            /** @var NewsItem $news_item */
            $news_item = $news->getNews(1)[0];
            $news->sendNotificationToUsers($news_item->getPreviewText(), $news_item->getId());

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