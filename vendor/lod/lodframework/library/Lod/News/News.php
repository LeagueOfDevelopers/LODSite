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
            "INSERT INTO `news` (`user_id`, `title`, `preview_text`, `text`, `photo`, `create_time`)
            VALUES (?i, ?s, ?s, ?s, ?s, ?i)",
            $user_id, $data['title'], $data['preview_text'], $data['text'], $data['photo'], time()
        );
        $this->db->query("COMMIT");
    }

    public function deleteNewsItem($news_id) {
        if (!is_numeric($news_id)) {
            return;
        }
        $this->db->query("UPDATE `news` SET `deleted` = '1' WHERE `id` = ?i", $news_id);
        $this->db->query("COMMIT");
    }

    public function updateNewsItem($data, $news_id) {
        if (!is_numeric($news_id)) {
            return;
        }
        $this->db->query(
            "UPDATE `news`
            SET `title` = ?s, `preview_text` = ?s, `text` = ?s, `photo` = ?s
            WHERE `id` = ?i",
            $data['title'], $data['preview_text'], $data['text'], $data['photo'], $news_id
        );
        $this->db->query("COMMIT");
    }

    public function getCount() {
        $result = $this->db->query("SELECT COUNT(*) FROM `news` WHERE `deleted` = '0'")->fetch_array();
        return $result[0];
    }

    public function getPagination($cur_page, $per_page) {
        $count = $this->getCount();
        $pages = intval($count / $per_page) + intval($count % $per_page != 0);
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

    public function getNewsItem($news_id) {
        if (!is_numeric($news_id)) {
            return null;
        }
        $news_item = new NewsItem($this->db);
        $news_item->allocateById($news_id);
        return $news_item->isEmpty() ? null : $news_item;
    }

    public function sendNotificationToUsers($text = "Новая новость", $news_id = 0) {
        $host = $_SERVER['HTTP_HOST'];

        $result = $this->db->query("SELECT * FROM `users` WHERE `confirmed` = '1' AND `admin_confirmed` = '1' AND `ban` = '0'");
        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
            $to = $row['email'];
            $subject = '[League Of Developers] Новая запись на стене Лиги';

            $message = '
            <html>
            <head>
                <title>League Of Developers. Новая запись на стене Лиги</title>
            </head>
            <body>
                <div style="max-width: 600px;margin: 0 auto;">
                    <div style="border-radius: 4px;border: 1px solid rgba(0, 0, 0, 0.06);background: #F0F0F0;">
                        <div style="background: #FAFAFA;padding: 15px;z-index: 10000;border-bottom: 1px solid #DCDCDC;margin-bottom: 15px;">
                            <a href="http://{2}/" style="display: block;">
                                <img alt="League Of Developers" src="http://{2}/st/img/lod-logo-horizontal.png" width="200">
                            </a>
                        </div>
                        <div style="padding: 15px; background-color: #C9E6F4; border-radius: 4px; border: 1px solid #b9d6e4;margin: 15px;">
                            Новая запись на стене Лиги:<br>
                            «{5}»
                            <br><br>
                            Для того, чтобы посмотреть новость полностью, пройдите по ссылке:
                            <br><br>
                            <a href="http://{2}/news?id={4}" style="color: #777;">http://{2}/news?id={4}</a>
                        </div>
                    </div>
                    <div style="text-align: center;color: #D2D2D2;">League Of Developers - {3}</div>
                </div>
            </body>
            </html>
            ';
            $message = str_replace(array('{0}', '{1}', '{2}', '{3}', '{4}', '{5}'), array(1, 2, $host, date('Y'), $news_id, $text), $message);

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

            $headers .= 'From: League Of Developers <notify@lod.misis.ru>' . "\r\n";

            mail($to, $subject, $message, $headers);
        }
    }
}