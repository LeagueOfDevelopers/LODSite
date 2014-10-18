<?php

namespace Lod\News;
define ('ASC', 1);
define('DESC', -1);

class News extends AbstractNews {

    private $db;

    /**
     * @param $db \Lod\Db\LodDatabase
     */
    function __construct(&$db) {
        $this->db = $db;
        parent::__construct($db);
    }

    public function getNews($count = 10, $offset = 0, $sort = DESC) {
        $sort_type = $sort == DESC ? 'DESC' : 'ASC';
        $result = $this->db->query(
            "SELECT * FROM `news`
            WHERE `deleted` <> '1'
            ORDER BY `id` $sort_type
            LIMIT ?i, ?i",
            $offset, $count
        );
        $news_list = array();
        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
            $news_item = new NewsItem($this->db, $row);
            array_push($news_list, $news_item);
        }
        return $news_list;
    }

    public function addNewsItem($data, $user_id) {
        $this->db->query(
            "INSERT INTO `news` (`user_id`, `title`, `preview_text`, `text`)
            VALUES (?i, ?s, ?s, ?s)",
            $user_id, $data['title'], $data['preview_text'], $data['text']
        );
    }

    public function deleteNewsItem($news_id) {
        if (!is_numeric($news_id)) {
            return;
        }
        $this->db->query("DELETE FROM `news` WHERE `id` = ?i", $news_id);
    }

    public function updateNewsItem($data) {
        $this->db->query(
            "UPDATE `news`
            SET `title` = ?s, `preview_text` = ?s, `text` = ?s",
            $data['title'], $data['preview_text'], $data['text']
        );
    }
}