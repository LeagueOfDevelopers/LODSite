<?php

namespace Lod\User\Validator;

use Lod\Core\Application;

class FieldsValidator {

    public static $patterns = array(
        'email' => "/^[-a-z0-9!#$%&'*+\/=?^_`{|}~]+(\.[-a-z0-9!#$%&'*+\/=?^_`{|}~]+)*@([a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)+(aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/i",
        'nickname' => "/^[a-z][0-9a-z_]{3,50}$/i",
        'password' => "/^.{6,128}$/",
        'github_account' => "/^[0-9a-z_]{2,50}$/i",
        'phone_number' => "/^\+?[0-9]{1,4}\s?\(?[0-9]{3}\)?(\s)?[0-9]{3}(\s|\-)?[0-9]{2}(\s|\-)?[0-9]{2}$/",
        'vk_profile' => "/^(http:\/\/|https:\/\/)(www\.)*vk\.com\/[a-z0-9._]{2,100}$/i",
        'enrollment_year' => "/^[1-2][0-9]{3}$/i",
        'name' => "/^[а-яА-ЯёЁ]+/",
        'skype' => "/^[0-9a-z_.-]{2,50}$/i",
        'faculty' => '/^[^<>]+$/i',
        'text' => '/^[^<>]+$/i'
    );

    public function isEmailValid($email) {
        if (preg_match(self::$patterns['email'], $email)) {
            return !0;
        }
        return !1;
    }

    public function isNickNameValid($nickname) {
        if (preg_match(self::$patterns['nickname'], $nickname)) {
            return !0;
        }
        return !1;
    }

    public function isPasswordValid($password) {
        if (preg_match(self::$patterns['password'], $password)) {
            return !0;
        }
        return !1;
    }

    public function isGitHubAccountValid($github_account) {
        if (preg_match(self::$patterns['github_account'], $github_account)) {
            return !0;
        }
        return !1;
    }

    public function isPhoneNumberValid($phone) {
        if (preg_match(self::$patterns['phone_number'], $phone)) {
            return !0;
        }
        return !1;
    }

    public function isVkProfileValid($vk_ref) {
        if (preg_match(self::$patterns['vk_profile'], $vk_ref)) {
            return !0;
        }
        return !1;
    }

    public function isEnrollmentYearValid($year) {
        if (preg_match(self::$patterns['enrollment_year'], $year)) {
            return !0;
        }
        return !1;
    }

    public function isNameValid($name) {
        if (preg_match(self::$patterns['name'], $name)) {
            return !0;
        }
        return !1;
    }

    public function isSkypeLoginValid($login) {
        if (preg_match(self::$patterns['skype'], $login)) {
            return !0;
        }
        return !1;
    }

    public function isFacultyValid($faculty) {
        if (preg_match(self::$patterns['faculty'], $faculty)) {
            return !0;
        }
        return !1;
    }

    public function isTextValid($text) {
        if (preg_match(self::$patterns['text'], $text)) {
            return !0;
        }
        return !1;
    }
}