<?php

namespace Lod\News\Comments;

use Lod\Core\Application;
use Lod\Db\LodDatabase;
use Lod\News\Comments\CommentItem\CommentItem;
use Lod\News\NewsItem;

class Comments {

    /**
     * @param $db LodDatabase
     */
    private $db;

    private $news_id;

    /**
     * @param LodDatabase $db
     * @param int $news_id
     */
    function __construct(&$db, $news_id = -1) {
        $this->db = $db;
        $this->news_id = $news_id;
    }

    public function setNewsId($news_id) {
        $this->news_id = $news_id;
        return $this;
    }

    public function getAllComments($count = 10, $sort = DESC) {
        $sort_type = $sort == DESC ? 'DESC' : 'ASC';
        $result = $this->db->query(
            "SELECT news.title AS news_title,
            comments.*
            FROM `comments`
            LEFT JOIN news ON comments.news_id = news.id
            WHERE comments.`deleted` = '0'
            ORDER BY `id` $sort_type
            LIMIT 0, ?i",
            $count
        );
        $comments_list = array();
        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
            $comment = new CommentItem($this->db, $row);
            array_push($comments_list, $comment);
        }
        return $comments_list;
    }

    public function getComments($sort = DESC) {
        $sort_type = $sort == DESC ? 'DESC' : 'ASC';
        $result = $this->db->query(
            "SELECT users.first_name AS parent_first_name,
            users.second_name AS parent_second_name,
            comments.*
            FROM `comments`
            LEFT JOIN users ON comments.parent_user_id = users.id
            WHERE comments.`deleted` = '0' AND `news_id` = ?i
            ORDER BY `id` $sort_type",
            $this->news_id
        );
        $comments_list = array();
        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
            $comment = new CommentItem($this->db, $row);
            array_push($comments_list, $comment);
        }

        return $comments_list;
    }

    public function addComment($user_id, $data) {
        $parent_user_id = $data['parent_user_id'] ? $data['parent_user_id'] : 0;
        $this->db->query(
            "INSERT INTO `comments` (`news_id`, `user_id`, `text`, `create_time`, parent_user_id)
            VALUES (?i, ?i, ?s, ?i, ?i)",
            $this->news_id, $user_id, $data['text'], time(), $parent_user_id
        );
        $inserted_id = $this->db->getDriver()->insert_id;
        $this->db->query("COMMIT");


        return array(
            'result' => true,
            'id' => $inserted_id
        );
    }

    public function deleteComment($comment_id) {
        $this->db->query(
            "UPDATE `comments` SET `deleted` = '1' WHERE `id` = ?i",
            $comment_id
        );
        $this->db->query("COMMIT");

        $result = $this->db->query(
            "SELECT `news_id` FROM `comments` WHERE `id` = ?i",
            $comment_id
        );
        $news_id = $result->fetch_array(MYSQL_ASSOC)['news_id'];

        $news_item = new NewsItem($this->db);
        $news_item->allocateById($news_id);
        $news_item->refreshCountComments();

        return $this;
    }
}