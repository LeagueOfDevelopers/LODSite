<?php

namespace Lod\User;

use Lod\Core\Application;
use Lod\Db\LodDatabase;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\Settings\UserCategories;

class User implements UserInterface {

    /**
     * @var $db LodDatabase
     */
    private $db;
    /**
     * @var $table_row array
     */
    private $table_row;
    /**
     * @var $check_auth CheckAuthorization
     */
    private $check_auth;

    function __construct(&$db, $row = null) {
        $this->db = $db;
        $this->table_row = $row;
    }

    public function setTableRow($row) {
        $this->table_row = $row;
    }

    public function allocateUserById($id) {
        if (is_numeric($id)) {
            $result = $this->db->query("SELECT * FROM `users` WHERE `id` = ?i", $id);
            $this->setTableRow($result->num_rows ? $result->fetch_array(MYSQL_ASSOC) : null);
        }
    }

    public function allocateUserByEmail($email) {
        $result = $this->db->query("SELECT * FROM `users` WHERE `email` = ?s", $email);
        $this->setTableRow($result->num_rows ? $result->fetch_array(MYSQL_ASSOC) : null);
    }

    public function allocateUserByNickName($nickname) {
        $result = $this->db->query("SELECT * FROM `users` WHERE `nickname` = ?s", $nickname);
        $this->setTableRow($result->num_rows ? $result->fetch_array(MYSQL_ASSOC) : null);
    }

    public function getObject() {
        return $this->table_row;
    }

    public function setCheckAuthorization(CheckAuthorization& $class) {
        $this->check_auth = $class;
        if ($this->isAuth()) {
            $this->updateRecentActivtyTime();
        }
    }

    public function isAuth() {
        return $this->check_auth && $this->table_row ? $this->check_auth->getResult() : false;
    }

    public function isEmpty() {
        return empty($this->table_row);
    }

    public function getId() {
        return $this->table_row['id'];
    }

    public function getAccessLevel() {
        return !empty($this->table_row['access_level']) ? $this->table_row['access_level'] : 0;
    }

    public function getCategoryName() {
        return UserCategories::defineCategoryName($this->getAccessLevel());
    }

    public function getCategoryColor() {
        return UserCategories::defineCategoryColor($this->getAccessLevel());
    }

    public function getEmail() {
        return $this->table_row['email'];
    }

    public function getPasswordHash() {
        return $this->table_row['password'];
    }

    public function getFirstName() {
        return $this->table_row['first_name'];
    }

    public function getLastName() {
        return $this->table_row['second_name'];
    }

    public function getFormatFullName() {
        $full_name = trim($this->getFirstName().' '.$this->getLastName());
        return !empty($full_name) ? $full_name : "ФИО не указано";
    }

    public function getViewName() {
        $first_name = $this->getFirstName();
        $second_name = $this->getLastName();
        if (empty($first_name) || empty($second_name)) {
            return $this->getNickName();
        }
        return $first_name.' '.$second_name;
    }

    public function getGitHubAccountName() {
        return !empty($this->table_row['github_account_name']) ? $this->table_row['github_account_name'] : null;
    }

    public function getGitHubReference() {
        if (!$this->getGitHubAccountName()) {
            return 'http://github.com/';
        }
        return 'http://github.com/'.$this->getGitHubAccountName();
    }

    public function getNickName() {
        return $this->table_row['nickname'];
    }

    public function getPhoneNumber() {
        return !empty($this->table_row['phone_number']) ? $this->table_row['phone_number'] : null;
    }

    public function getVkProfileReference() {
        return !empty($this->table_row['vk_profile']) ? $this->table_row['vk_profile'] : null;
    }

    public function getSkypeAccountName() {
        return !empty($this->table_row['skype']) ? $this->table_row['skype'] : null;
    }

    public function getFaculty() {
        return !empty($this->table_row['faculty']) ? $this->table_row['faculty'] : null;
    }

    public function getUniversityGroup() {
        return !empty($this->table_row['university_group']) ? $this->table_row['university_group'] : null;
    }

    public function getUniversityEnrollmentYear() {
        return !empty($this->table_row['university_enrollment_year']) ? $this->table_row['university_enrollment_year'] : null;
    }

    public function getUniversityCourse() {
        $year = $this->getUniversityEnrollmentYear();
        if (empty($year) && !preg_match("/^[0-9]{4}$/i", trim($year))) {
            return null;
        }
        $cur_year = intval(date('Y'));
        $cur_month = intval(date('n'));
        $course_number = $cur_year - $year + intval($cur_month >= 9);
        if ($course_number < 1) {
            $course_number = 1;
        }
        if ($course_number > 4) {
            $course_number = 'Закончил'.($this->getSex() == 'b' ? '' : 'a').' в '.($year + 4).' году';
        } else {
            $course_number = $course_number.' курс';
        }
        return $course_number;
    }

    public function getRegisterTime() {
        return !empty($this->table_row['register_time']) ? $this->table_row['register_time'] : null;
    }

    public function getRegisterDate() {
        return date("d.m.Y в H:i", $this->getRegisterTime());
    }

    public function getLastLoggedTime() {
        return !empty($this->table_row['last_logged_time']) ? $this->table_row['last_logged_time'] : null;
    }

    public function getLastLoggedDate() {
        return date("d.m.Y в H:i", $this->getLastLoggedTime());
    }

    public function getLastLoggedLater() {
        if ($this->getLastLoggedTime()) {
            return $this->formatEllapsedTime($this->getLastLoggedTime());
        }
        return "1 минуту назад";
    }

    public function getViewCount() {
        return !empty($this->table_row['view_count']) ? $this->table_row['view_count'] : 0;
    }

    public function getPublicLoginKey() {
        return !empty($this->table_row['login_key']) ? $this->table_row['login_key'] : null;
    }

    public function getSex() {
        return !empty($this->table_row['sex']) ? $this->table_row['sex'] : 'b';
    }

    public function getViewSex() {
        $sex = $this->getSex();
        return $sex == 'b' ? 'Мужской' : 'Женский';
    }

    public function getRecentActivityTime() {
        return !empty($this->table_row['recent_activity_time']) ? intval($this->table_row['recent_activity_time']) : 0;
    }

    public function getRecentActivityDate() {
        return date("d.m.Y в H:i", $this->getRecentActivityTime());
    }

    public function getRecentActivityEllapsed() {
        $time = $this->getRecentActivityTime();
        if (!$time) {
            return 'Еще не был'.($this->getSex() == 'b' ? '' : 'a').' на сайте';
        }
        return 'Был'.($this->getSex() == 'b' ? '' : 'a').' в сети '.$this->formatEllapsedTime($time);
    }

    public function isOnline() {
        $recent_activity_time = $this->getRecentActivityTime();
        $cur_time = time();
        $offset = $cur_time - $recent_activity_time;
        return $offset < 300 && $this->getPublicLoginKey();
    }

    public function getAbout() {
        return !empty($this->table_row['about']) ? htmlspecialchars($this->table_row['about']) : "Информация отсутствует";
    }

    public function getPhotoLink() {
        return !empty($this->table_row['photo']) ? $this->table_row['photo'] : "http://{$_SERVER['HTTP_HOST']}/st/img/noimage.png";
    }

    public function getResetPasswordKey() {
        return !empty($this->table_row['password_reset_key']) ? $this->table_row['password_reset_key'] : null;
    }

    public function isBan() {
        return intval($this->table_row['ban']) != 0;
    }

    public function setEmail($email) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `email` = ?s WHERE `id` = ?i", $email, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['email'] = $email;
    }

    public function setAccessLevel($level) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `access_level` = ?i WHERE `id` = ?i", $level, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['access_level'] = $level;
    }

    public function changePassword($password) {
        $this->setPasswordHash(md5(md5($password.';')));
    }

    public function setPasswordHash($password_hash) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `password` = ?s WHERE `id` = ?i", $password_hash, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['password'] = $password_hash;
    }

    public function setFirstName($first_name) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `first_name` = ?s WHERE `id` = ?i", $first_name, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['first_name'] = $first_name;
    }

    public function setLastName($second_name) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `second_name` = ?s WHERE `id` = ?i", $second_name, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['second_name'] = $second_name;
    }

    public function setGitHubAccountName($name) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `github_account_name` = ?s WHERE `id` = ?i", $name, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['github_account_name'] = $name;
    }

    public function setNickName($nickname) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `nickname` = ?s WHERE `id` = ?i", $nickname, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['nickname'] = $nickname;
    }

    public function setPhoneNumber($phone) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `phone_number` = ?s WHERE `id` = ?i", $phone, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['phone_number'] = $phone;
    }

    public function setVkProfileReference($ref) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `vk_profile` = ?s WHERE `id` = ?i", $ref, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['vk_profile'] = $ref;
    }

    public function setSkypeAccountName($account) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `skype` = ?s WHERE `id` = ?i", $account, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['skype'] = $account;
    }

    public function setFaculty($faculty) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `faculty` = ?s WHERE `id` = ?i", $faculty, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['faculty'] = $faculty;
    }

    public function setUniversityGroup($group) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `university_group` = ?s WHERE `id` = ?i", $group, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['university_group'] = $group;
    }

    public function setUniversityEnrollmentYear($year) {
        $user_id = $this->getId();
        if (!is_numeric($user_id) || empty($year)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `university_enrollment_year` = ?i WHERE `id` = ?i", $year, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['university_enrollment_year'] = $year;
    }

    public function incrementViewCount() {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `view_count` = `view_count` + 1 WHERE `id` = ?i", $user_id);
        $this->db->query("COMMIT");
        $this->table_row['view_count']++;
    }

    public function updateLastLoggedTime() {
        $user_id = $this->getId();
        $cur_time = time();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `last_logged_time` = ?i WHERE `id` = ?i", $cur_time, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['last_logged_time'] = $cur_time;
    }

    public function setSex($sex) {
        if ($sex != 'b' && $sex != 'g') {
            return;
        }
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `sex` = ?s WHERE `id` = ?i", $sex, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['sex'] = $sex;
    }

    public function updateRecentActivtyTime() {
        $user_id = $this->getId();
        $cur_time = time();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `recent_activity_time` = ?i WHERE `id` = ?i", $cur_time, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['recent_activity_time'] = $cur_time;
    }

    public function setAbout($text) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `about` = ?s WHERE `id` = ?i", $text, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['about'] = $text;
    }

    public function setPhoto($ref) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `photo` = ?s WHERE `id` = ?i", $ref, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['photo'] = $ref;
    }

    private function formatEllapsedTime($time) {
        $cur_time = time();
        $diff = $cur_time - $time;
        if ($diff <= 0) {
            return '1 минуту назад';
        }
        $seconds = $diff;
        $minutes = intval($seconds / 60);
        $hours = intval($minutes / 60);
        if ($seconds < 60) {
            return $seconds.' '.$this->wordSeconds($seconds).' назад';
        }
        if ($minutes < 60) {
            return $minutes.' '.$this->wordMinutes($minutes).' назад';
        }
        if ($hours < 12) {
            return $hours.' '.$this->wordHours($hours).' назад';
        }
        return date("d.m.Y в H:i", $time);
    }

    private function wordSeconds($seconds) {
        $word = "секунд";
        $array_of_suf_unique = ['', 'у', 'ы'];
        $array_of_suf_dozen = ['', 'у', 'ы', 'ы', 'ы', '', '', '', '', ''];
        $mod = $seconds % 100;
        if ($mod >= 11 && $mod <= 14) {
            return $word.$array_of_suf_unique[0];
        } else {
            $mod %= 10;
            return $word.$array_of_suf_dozen[$mod];
        }
    }

    private function wordMinutes($minutes) {
        $word = "минут";
        $array_of_suf_unique = ['', 'у', 'ы'];
        $array_of_suf_dozen = ['', 'у', 'ы', 'ы', 'ы', '', '', '', '', ''];
        $mod = $minutes % 100;
        if ($mod >= 11 && $mod <= 14) {
            return $word.$array_of_suf_unique[0];
        } else {
            $mod %= 10;
            return $word.$array_of_suf_dozen[$mod];
        }
    }

    private function wordHours($hours) {
        $word = "час";
        $array_of_suf_unique = ['', 'а', 'ов'];
        $array_of_suf_dozen = ['ов', '', 'а', 'а', 'а', 'ов', 'ов', 'ов', 'ов', 'ов'];
        $mod = $hours % 100;
        if ($mod >= 11 && $mod <= 14) {
            return $word.$array_of_suf_unique[2];
        } else {
            $mod %= 10;
            return $word.$array_of_suf_dozen[$mod];
        }
    }

    public function setBan() {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `ban` = '1' WHERE `id` = ?i", $user_id);
        $this->db->query("COMMIT");
        $this->table_row['ban'] = '1';
    }

    public function unBan() {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `ban` = '0' WHERE `id` = ?i", $user_id);
        $this->db->query("COMMIT");
        $this->table_row['ban'] = '0';
    }

    public function setAdminConfirm() {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `admin_confirmed` = '1' WHERE `id` = ?i", $user_id);
        $this->db->query("COMMIT");
        $this->table_row['admin_confirmed'] = '1';
    }

    public function setResetPasswordKey($key) {
        $user_id = $this->getId();
        if (!is_numeric($user_id)) {
            return;
        }
        $this->db->query("UPDATE `users` SET `password_reset_key` = ?s WHERE `id` = ?i", $key, $user_id);
        $this->db->query("COMMIT");
        $this->table_row['password_reset_key'] = $key;
    }
}