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
    }

    public function isAuth() {
        return $this->check_auth && $this->table_row ? $this->check_auth->getResult() : false;
    }

    public function getId() {
        return $this->table_row['id'];
    }

    public function getAccessLevel() {
        return $this->table_row['access_level'];
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
            return 'Неизвестно';
        }
        $cur_year = intval(date('Y'));
        $cur_month = intval(date('n'));
        $course_number = $cur_year - $year + intval($cur_month >= 9);
        if ($course_number < 1) {
            $course_number = 1;
        }
        if ($course_number > 4) {
            $course_number = 'Закончил(-а) в '.($year + 4).' году';
        } else {
            $course_number = $course_number.' курс';
        }
        return $course_number;
    }

    public function getRegisterTime() {
        return !empty($this->table_row['register_time']) ? $this->table_row['register_time'] : null;
    }

    public function getLastLoggedTime() {
        return !empty($this->table_row['last_logged_time']) ? $this->table_row['last_logged_time'] : null;
    }

    public function getLastLoggedDate() {
        return date("d.m.Y в H:i", $this->getLastLoggedTime());
    }

    public function getLastLoggedLater() {
        if ($this->getLastLoggedTime()) {
            $offset = time() - $this->getLastLoggedTime();
            $seconds = $offset;
            $minutes = intval($offset / 60);
            $hours = intval($minutes / 60);
            $days = intval($hours / 60);
            //TODO: finish the function
            return $offset. " секунд назад";
        }
        return "1 минуту назад";
    }

    public function getViewCount() {
        return !empty($this->table_row['view_count']) ? $this->table_row['view_count'] : null;
    }

    public function getPublicLoginKey() {
        return !empty($this->table_row['login_key']) ? $this->table_row['login_key'] : null;
    }

    public function getSex() {
        return !empty($this->table_row['sex']) ? $this->table_row['sex'] : 'b';
    }

    public function isBan() {
        return $this->table_row['ban'] != 0;
    }

    public function unBan() {}

    public function setBan() {}

    public function setResetPasswordKey() {}

    public function setAccessLevel($access_level) {}

    public function setEmail($email) {}

    public function setPasswordHash($password_hash) {}

    public function setFirstName($first_name) {}

    public function setLastName($second_name) {}

    public function setGitHubAccountName($name) {}

    public function setNickName($nickname) {}

    public function setPhoneNumber($phone) {}

    public function setVkProfileReference($ref) {}

    public function setSkypeAccountName($account) {}

    public function setFaculty($faculty) {}

    public function setUniversityGroup($group) {}

    public function setUniversityEnrollmentYear($year) {}

    public function incrementViewCount() {}

    public function updateLastLoggedTime() {}
}