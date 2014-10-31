<?php

namespace Lod\User\Registration;

use Lod\User\User;
use Lod\User\Validator\FieldsValidator;

class Registration implements RegistrationInterface {

    private $db;
    private $data;

    private $result = false;

    /**
     * @param $db \Lod\Db\LodDatabase
     * @param $data
     */
    function __construct(&$db, $data) {
        $this->db = $db;
        $this->data = $data;
    }

    public function signUp() {
        $email = $this->data['email'];
        $nickname = $this->data['login'];
        $first_name = $this->data['first_name'];
        $second_name = $this->data['last_name'];
        $password = $this->data['password'];
        $confirm_password = $this->data['passwordagain'];
        $sex = $this->data['sex'];

        $vk_profile = $this->data['vk_profile'];
        $github_account = $this->data['github_account'];
        $phone = $this->data['phone'];
        $skype = $this->data['skype'];

        $faculty = $this->data['faculty'];
        $university_group = $this->data['university_group'];
        $enrollment_year = $this->data['enrollment_year'];

        $about = $this->data['about'];

        $validator = new FieldsValidator();

        if (!$validator->isEmailValid($email)) {
            return;
        }
        if (!$validator->isNickNameValid($nickname)) {
            return;
        }
        if (!$validator->isNameValid($first_name) || !$validator->isNameValid($second_name)) {
            return;
        }
        if (!$validator->isPasswordValid($password) || $password != $confirm_password) {
            return;
        }
        if ($sex != 'b' && $sex != 'g') {
            return;
        }
        if (!$validator->isVkProfileValid($vk_profile)) {
            return;
        }
        if (!$validator->isGitHubAccountValid($github_account)) {
            return;
        }
        if (!$validator->isPhoneNumberValid($phone)) {
            return;
        }
        if (!$validator->isSkypeLoginValid($skype)) {
            $skype = '';
        }
        if (!$validator->isFacultyValid($faculty)) {
            $faculty = '';
        }
        if (!$validator->isTextValid($university_group)) {
            $university_group = '';
        }
        if (!$validator->isEnrollmentYearValid($enrollment_year)) {
            $enrollment_year = '';
        }


        $result = $this->db->query("SELECT * FROM `users` WHERE `nickname` = ?s or `email` = ?s", $nickname, $email);
        if ($result->num_rows) {
            return;
        }

        $this->saveUser(array(
            'email' => $email,
            'nickname' => $nickname,
            'first_name' => $first_name,
            'second_name' => $second_name,
            'password' => $password,
            'sex' => $sex,
            'vk_profile' => $vk_profile,
            'github_account' => $github_account,
            'phone' => $phone,
            'skype' => $skype,
            'faculty' => $faculty,
            'group' => $university_group,
            'enrollment_year' => $enrollment_year,
            'about' => $about
        ));
    }

    private function saveUser($user) {
        $user['password'] = md5(md5($user['password'].';'));
        $confirm_key = $this->generateKey();
        $this->db->query(
            "INSERT INTO `users` (`email`,`password`,`first_name`,`second_name`,`nickname`,`register_time`,`confirm_key`) VALUES(?s, ?s, ?s, ?s, ?s, ?i, ?s)",
            $user['email'], $user['password'], $user['first_name'], $user['second_name'], $user['nickname'], time(), $confirm_key
        );
        $this->db->query("COMMIT");

        $user_row = $this->db->query("SELECT * FROM `users` WHERE `nickname` = ?s", $user['nickname'])->fetch_array(MYSQL_ASSOC);
        $this->sendKeyOnEmail($user['email'], $user_row['id'], $confirm_key);

        $user_object = new User($this->db, $user_row);
        $user_object->setSex($user['sex']);
        $user_object->setVkProfileReference($user['vk_profile']);
        $user_object->setGitHubAccountName($user['github_account']);
        $user_object->setPhoneNumber($user['phone']);
        $user_object->setSkypeAccountName($user['skype']);
        $user_object->setFaculty($user['faculty']);
        $user_object->setUniversityGroup($user['group']);
        $user_object->setUniversityEnrollmentYear($user['enrollment_year']);
        $user_object->setAbout($user['about']);

        $this->result = true;
    }

    private function sendKeyOnEmail($email, $id, $key) {
        $host = $_SERVER['HTTP_HOST'];

        $to = $email;
        $subject = '[League Of Developers] Активация аккаунта';

        $message = '
            <html>
            <head>
                <title>League Of Developers. Активация аккаунта</title>
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
                            Для того, чтобы активировать аккаунт, перейдите по этой ссылке:<br>
                            <a href="http://{2}/user/confirm?id={0}&key={1}" title="Активировать аккаунт" style="color: #777;">http://{2}/user/confirm?id={0}&key={1}</a>
                        </div>
                    </div>
                    <div style="padding: 10px 0;text-align: center;color: #777;">Если вы не знаете что это за письмо, просто проигнорируйте его.</div>
                    <div style="text-align: center;color: #D2D2D2;">League Of Developers - {3}</div>
                </div>
            </body>
            </html>
            ';
        $message = str_replace(array('{0}', '{1}', '{2}', '{3}'), array($id, $key, $host, date('Y')), $message);

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $headers .= 'From: League Of Developers <confirm@lod.misis.ru>' . "\r\n";

        mail($to, $subject, $message, $headers);
    }

    private function generateKey() {
        return md5(mktime().rand(1, 10e9));
    }

    public function getResult() {
        return $this->result;
    }
}