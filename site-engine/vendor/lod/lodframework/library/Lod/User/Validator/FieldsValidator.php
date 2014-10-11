<?php

namespace Lod\User\Validator;

class FieldsValidator {

    public static $patterns = array(
        'email' => "/^[-a-z0-9!#$%&'*+/=?^_`{|}~]+(\.[-a-z0-9!#$%&'*+/=?^_`{|}~]+)*@([a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/i",
        'nickname' => "/^[a-z][0-9a-z_]{3,50}$/i",
        'password' => "/^.{6,128}$/",
        'github_account' => "/^[a-z][0-9a-z_]{2,50}$/i",
        'phone_number' => "/^\+*[0-9]{9,14}$/i",
        'vk_profile' => "/^(http:\/\/|https:\/\/)*(www\.)*vk\.com\/[a-z0-9._]{2,100}$/i",
        'enrollment_year' => "/^[1-2][0-9]{3}$/i"
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
}