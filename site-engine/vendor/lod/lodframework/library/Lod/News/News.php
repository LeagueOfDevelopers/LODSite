<?php

namespace Lod\News;
use Lod\Core\Application;

define ('ASC', 1);
define('DESC', -1);

class News extends AbstractNews {

    public static $PER_PAGE = 10;

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

    public function getCount() {
        $result = $this->db->query("SELECT COUNT(*) FROM `news` WHERE `deleted` = '0'")->fetch_array();
        return $result[0];
    }

    public function getPagination($cur_page, $per_page) {
        $count = $this->getCount();
        $pages = intval($count / $per_page) + 1;
        $start = $cur_page - 4 < 1 ? 1 : $cur_page - 4;
        $finish = $start + 8 > $pages ? $pages : $start + 8;
        $start = $finish - 8 < 1 ? $start : $finish - 8;
        for ($pages_array = array(), $i = $start; $i <= $finish; ++$i) {
            $pages_array[] = array(
                'active' => $i == $cur_page,
                'view_number' => $i,
                'page' => $i
            );
        }
        $left = array(
            'disabled' => $cur_page == 1,
            'view_symbol' => '«',
            'value' => $cur_page - 1
        );
        $right = array(
            'disabled' => $cur_page == $pages,
            'view_symbol' => '»',
            'value' => $cur_page + 1
        );
        return array(
            'left' => $left,
            'pagination' => $pages_array,
            'right' => $right
        );
    }
}