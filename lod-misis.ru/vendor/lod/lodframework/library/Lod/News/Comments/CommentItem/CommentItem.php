<?php

namespace Lod\News\Comments\CommentItem;

use Lod\Core\Application;
use Lod\Db\LodDatabase;
use Lod\User\User;

class CommentItem implements CommentItemInterface {

    /**
     * @var $db LodDatabase
     */
    private $db;
    /**
     * @var $row array
     */
    private $row;

    function __construct(&$db, $row = null) {
        $this->db = $db;
        $this->row = $row;
    }

    public function setTableRow($row) {
        $this->row = $row;
    }

    public function allocateById($comment_id) {
        if (!$comment_id) {
            return;
        }
        $result = $this->db->query(
            "SELECT users.first_name AS parent_first_name,
            users.second_name AS parent_second_name,
            comments.*
            FROM `comments`
            LEFT JOIN users ON comments.parent_user_id = users.id
            WHERE comments.`id` = ?i AND comments.`deleted` = '0'",
            $comment_id
        );
        $this->row = $result->fetch_array(MYSQL_ASSOC);
    }

    public function getObject() {
        return $this->row;
    }

    public function isEmpty() {
        return empty($this->row);
    }

    public function getId() {
        return $this->row ? $this->row['id'] : 0;
    }

    public function getUserId() {
        return $this->row ? $this->row['user_id'] : 0;
    }

    public function getNewsId() {
        return $this->row ? $this->row['news_id'] : 0;
    }

    public function getText() {
        return $this->row ? strip_tags($this->row['text']) : null;
    }

    public function getFormattedText() {
        $patterns = array(
            '/\[((http|https)\:\/\/(www\.)?[^\r\n\t\f \[\]]*)\]/i',
            '/\s((http|https)\:\/\/(www\.)?[^\r\n\t\f }{]*)\s/i',
            '/\s\-\-\s/i'
        );
        $replacements = array(
            " <div class=\"row\" style='margin: 10px 0'><div class=\"col-xs-6 col-md-6\" style='padding-left: 0;'><a class=\"thumbnail\" style=\"max-width: 100%; margin-bottom: 0;\"><img src=\"$1\"></a></div></div> ",
            " <a target=\"_blank\" href=\"$1\">$1</a> ",
            " — "
        );
        $text = ' '.$this->getText().' ';
        for ($i = 0; $i < count($patterns); $i++) {
            $text = preg_replace($patterns[$i], $replacements[$i], $text);
        }
        return $text;
    }

    public function getUserObject() {
        $user_id = $this->getUserId();
        $user = new User($this->db);
        $user->allocateUserById($user_id);
        return $user;
    }

    public function getTime() {
        return $this->row ? $this->row['create_time'] : 0;
    }

    public function getDate() {
        return date("d.m.Y в H:i", $this->getTime());
    }

    public function getParentId() {
        return $this->row ? $this->row['parent_user_id'] : 0;
    }

    public function getParentViewName() {
        $parent_id = $this->getParentId();
        if (!$parent_id) {
            return null;
        }
        if (empty($this->row['parent_first_name']) || empty($this->row['parent_second_name'])) {
            $parent_user = new User($this->db);
            $parent_user->allocateUserById($parent_id);
            return $parent_user->getViewName();
        }
        return $this->row['parent_first_name'].' '.$this->row['parent_second_name'];
    }

    public function setUserId($user_id) {
        $comment_id = $this->getId();
        if (!is_numeric($comment_id) || !is_numeric($user_id) || $comment_id <= 0) {
            return;
        }
        $this->db->query("UPDATE `comments` SET `user_id` = ?i WHERE `id` = ?i", $user_id, $comment_id);
        $this->db->query("COMMIT");
        $this->row['user_id'] = $user_id;
    }

    public function setParentId($parent_user_id) {
        $comment_id = $this->getId();
        if (!is_numeric($comment_id) || !is_numeric($parent_user_id) || $comment_id <= 0) {
            return;
        }
        $this->db->query("UPDATE `comments` SET `parent_user_id` = ?i WHERE `id` = ?i", $parent_user_id, $comment_id);
        $this->db->query("COMMIT");
        $this->row['parent_user_id'] = $parent_user_id;
    }

    public function setText($text) {
        $comment_id = $this->getId();
        if (!is_numeric($comment_id) || $comment_id <= 0) {
            return;
        }
        $this->db->query("UPDATE `comments` SET `text` = ?s WHERE `id` = ?i", $text, $comment_id);
        $this->db->query("COMMIT");
        $this->row['text'] = $text;
    }

    public function canDelete() {
        $time = $this->getTime();
        return time() - $time < 60 * 60; /* 1 hour */
    }
}