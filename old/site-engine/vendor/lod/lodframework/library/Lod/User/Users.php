<?php

namespace Lod\User;

class Users {

    public static $PER_PAGE = 20;

    private $db;

    /**
     * @param $db \Lod\Db\LodDatabase
     */
    function __construct(&$db) {
        $this->db = $db;
    }

    public function getUsers($count = 10, $offset = 0, $sort = DESC) {
        $sort_type = $sort == DESC ? 'DESC' : 'ASC';
        $result = $this->db->query(
            "SELECT * FROM `users`
            WHERE `confirmed` = '1' AND `admin_confirmed` = '1'
            ORDER BY `id` $sort_type
            LIMIT ?i, ?i",
            $offset, $count
        );
        $users_list = array();
        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
            $user_item = new User($this->db, $row);
            array_push($users_list, $user_item);
        }
        return $users_list;
    }

    public function getNewUsers($sort = DESC) {
        $sort_type = $sort == DESC ? 'DESC' : 'ASC';
        $result = $this->db->query(
            "SELECT * FROM `users`
            WHERE `confirmed` = '1' AND `admin_confirmed` = '0' AND `ban` = '0'
            ORDER BY `id` $sort_type"
        );
        $users_list = array();
        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
            $user_item = new User($this->db, $row);
            array_push($users_list, $user_item);
        }
        return $users_list;
    }

    public function getCount() {
        $result = $this->db->query("SELECT COUNT(*) FROM `users` WHERE `ban` = '0' AND `confirmed` = '1' AND `admin_confirmed` = '1'")->fetch_array();
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

    public function getUserItem($user_id) {
        if (!is_numeric($user_id)) {
            return null;
        }
        $user = new User($this->db);
        $user->allocateUserById($user_id);
        return $user;
    }
}