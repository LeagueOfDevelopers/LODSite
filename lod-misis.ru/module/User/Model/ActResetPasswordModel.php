<?php

namespace User\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\User;
use Lod\User\Validator\FieldsValidator;

class ActResetPasswordModel extends AbstractModel {

    public function main() {
        $email = Application::$request_variables['post']['email'];

        $validator = new FieldsValidator();
        if (!$validator->isEmailValid($email)) {
            $this->setData(array(
                'result' => false
            ));
            return $this;
        }

        $user = new User($this->getLodDb());
        $user->allocateUserByEmail($email);

        if ($user->isEmpty() || $user->isBan()) {
            $this->setData(array(
                'result' => false
            ));
            return $this;
        }

        $key = $this->generateKey();
        $user->setResetPasswordKey($key);

        $this->sendNotificationToUser($user);

        $this->setData(array(
            'result' => true
        ));

        return $this;
    }

    private function generateKey() {
        return md5(mktime().rand(1,1e9));
    }

    /**
     * @param $user User
     */
    private function sendNotificationToUser($user) {
        $host = $_SERVER['HTTP_HOST'];

        $to = $user->getEmail();
        $subject = '[League Of Developers] Сброс пароля';

        $message = '
        <html>
        <head>
            <title>League Of Developers. Сброс пароля</title>
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
                        Для того, чтобы сбросить свой пароль, пройдите по ссылке:<br>
                        <a href="http://{2}/user/new_password?key={4}" title="Сброс пароля" style="color: #777;">http://{2}/user/new_password?key={4}</a>
                    </div>
                </div>
                <div style="padding: 10px 0;text-align: center;color: #777;">Если вы не знаете что это за письмо, просто проигнорируйте его.</div>
                <div style="text-align: center;color: #D2D2D2;">League Of Developers - {3}</div>
            </div>
        </body>
        </html>
        ';
        $message = str_replace(array('{0}', '{1}', '{2}', '{3}', '{4}'), array(1, 2, $host, date('Y'), $user->getResetPasswordKey()), $message);

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $headers .= 'From: League Of Developers <reset@lod.misis.ru>' . "\r\n";

        mail($to, $subject, $message, $headers);
    }
}