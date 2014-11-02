<?php

namespace News\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\News\Comments\CommentItem\CommentItem;
use Lod\News\Comments\Comments;
use Lod\News\News;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class DeleteCommentModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        $comment_id = Application::$request_variables['post']['id'];

        if (!is_numeric($comment_id) || !$user->isAuth() || $user->isBan()) {
            $this->setData(array(
                'result' => false,
                'message' => 'Невозможно удалить комментарий'
            ));
            return $this;
        }

        $comment = new CommentItem($this->getLodDb());
        $comment->allocateById($comment_id);
        if (($user->getId() != $comment->getUserId() || !$comment->canDelete()) && $user->getAccessLevel() < 8) {
            $this->setData(array(
                'result' => false,
                'message' => 'Невозможно удалить комментарий'
            ));
            return $this;
        }

        $comments = new Comments($this->getLodDb());
        $comments->deleteComment($comment_id);

        $this->setData(array(
            'result' => true,
            'comment_id' => $comment_id
        ));

        return $this;
    }
}