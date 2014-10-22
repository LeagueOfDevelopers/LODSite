<?php

namespace Lod\News;

use Lod\Core\Application;
use Lod\News\Comments\Comments;
use Lod\User\User;

class NewsItem implements NewsItemInterface {

    /**
     * @var $db \Lod\Db\LodDatabase
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

    public function isEmpty() {
        return empty($this->row);
    }

    public function allocateById($news_id) {
        if (!$news_id) {
            return;
        }
        $result = $this->db->query("SELECT * FROM `news` WHERE `id` = ?i AND `deleted` = '0'", $news_id);
        $this->row = $result->fetch_array(MYSQL_ASSOC);
    }

    public function getObject() {
        return $this->row;
    }

    public function getId() {
        return $this->row ? $this->row['id'] : 0;
    }

    public function getUserId() {
        return $this->row ? $this->row['user_id'] : 0;
    }

    public function getTitle() {
        return $this->row ? $this->row['title'] : null;
    }

    public function getPreviewText() {
        return $this->row ? $this->row['preview_text'] : null;
    }

    public function getText() {
        return $this->row ? $this->row['text'] : null;
    }

    public function getFormattedText() {
        $patterns = array(
            '/\[((http|https)\:\/\/(www\.)?[^\r\n\t\f \[\]]*)\]/i',
            '/\s((http|https)\:\/\/(www\.)?[^\r\n\t\f }{]*)\s/i',
            '/\s\-\-\s/i'
        );
        $replacements = array(
            " <div class=\"row\" style='margin: 10px 0'><div class=\"col-xs-12 col-md-12\"><a class=\"thumbnail\" style=\"max-width: 100%; margin-bottom: 0;\"><img src=\"$1\"></a></div></div> ",
            " <a target=\"_blank\" href=\"$1\">$1</a> ",
            " — "
        );
        $text = ' '.$this->getText().' ';
        for ($i = 0; $i < count($patterns); $i++) {
            $text = preg_replace($patterns[$i], $replacements[$i], $text);
        }
        return $text;
    }

    public function getCountComments() {
        return $this->row ? $this->row['count_comments'] : 0;
    }

    public function getCountViews() {
        return $this->row ? $this->row['count_views'] : 0;
    }

    public function getPhoto() {
        return $this->row ? $this->row['photo'] : null;
    }

    /**
     * @return User
     */
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

    public function getCommentsObject() {
        return new Comments($this->db, $this->getId());
    }

    public function incrementCountViews() {
        $news_id = $this->getId();
        if (!is_numeric($news_id)) {
            return;
        }
        $this->db->query("UPDATE `news` SET `count_views` = `count_views` + 1 WHERE `id` = ?i", $news_id);
        $this->db->query("COMMIT");
        $this->row['count_views']++;
    }

    public function incrementCountComments() {
        $news_id = $this->getId();
        if (!is_numeric($news_id)) {
            return;
        }
        $this->db->query("UPDATE `news` SET `count_comments` = `count_comments` + 1 WHERE `id` = ?i", $news_id);
        $this->db->query("COMMIT");
        $this->row['count_comments']++;
    }

    public function refreshCountComments() {
        $news_id = $this->getId();
        if (!is_numeric($news_id)) {
            return;
        }
        $row = $this->db->query("SELECT COUNT(*) FROM `comments` WHERE `news_id` = ?i AND `deleted` = '0'", $news_id)->fetch_array();
        if (!count($row)) {
            return;
        }
        $count = $row[0];
        $this->db->query("UPDATE `news` SET `count_comments` = ?i WHERE `id` = ?i", $count, $news_id);
        $this->db->query("COMMIT");
        $this->row['count_comments'] = $count;
    }

    public function setUserId($user_id) {
        $news_id = $this->getId();
        if (!is_numeric($news_id) || !is_numeric($user_id) || $user_id <= 0) {
            return;
        }
        $this->db->query("UPDATE `news` SET `user_id` = ?i WHERE `id` = ?i", $user_id, $news_id);
        $this->db->query("COMMIT");
        $this->row['user_id'] = $user_id;
    }

    public function setTitle($title) {
        $news_id = $this->getId();
        if (!is_numeric($news_id)) {
            return;
        }
        $this->db->query("UPDATE `news` SET `title` = ?s WHERE `id` = ?i", $title, $news_id);
        $this->db->query("COMMIT");
        $this->row['title'] = $title;
    }

    public function setPreviewText($preview) {
        $news_id = $this->getId();
        if (!is_numeric($news_id)) {
            return;
        }
        $this->db->query("UPDATE `news` SET `preview_text` = ?s WHERE `id` = ?i", $preview, $news_id);
        $this->db->query("COMMIT");
        $this->row['preview_text'] = $preview;
    }

    public function setText($text) {
        $news_id = $this->getId();
        if (!is_numeric($news_id)) {
            return;
        }
        $this->db->query("UPDATE `news` SET `text` = ?s WHERE `id` = ?i", $text, $news_id);
        $this->db->query("COMMIT");
        $this->row['text'] = $text;
    }

    public function setPhoto($photo_link) {
        $news_id = $this->getId();
        if (!is_numeric($news_id)) {
            return;
        }
        $this->db->query("UPDATE `news` SET `photo` = ?s WHERE `id` = ?i", $photo_link, $news_id);
        $this->db->query("COMMIT");
        $this->row['photo'] = $photo_link;
    }
}