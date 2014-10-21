<?php

namespace News\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\News\News;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class AddCommentModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        $news_id = isset(Application::$request_variables['post']['news_id']) ? intval(Application::$request_variables['post']['news_id']) : false;
        $text = Application::$request_variables['post']['text'];

        if (!$news_id || !$user->isAuth() || $user->isBan() || !$text) {
            $this->setData(array(
                'result' => false,
                'message' => 'Невозможно добавить комментарий'
            ));
            return $this;
        }

        $news = new News($this->getLodDb());
        $news_item = $news->getNewsItem($news_id);

        if (!$news_item) {
            $this->setData(array(
                'result' => false,
                'message' => 'Невозможно добавить комментарий'
            ));
            return $this;
        }

        $result = $news_item->getCommentsObject()->addComment($user->getId(), Application::$request_variables['post']);
        if ($result['result']) {
            $news_item->incrementCountComments();
        }

        $this->setData(array(
            'result' => $result['result'],
            'inserted_id' => $result['id']
        ));

        return $this;
    }
}