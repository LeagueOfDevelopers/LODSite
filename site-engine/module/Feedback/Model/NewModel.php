<?php

namespace Feedback\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Validator\FieldsValidator;

class NewModel extends AbstractModel {

    public function main() {
        $data = Application::$request_variables['post'];
        $email = $data['email'];
        $text = $data['text'];

        $validator = new FieldsValidator();
        if (!$validator->isEmailValid($email)) {
            $this->setData(array(
                'result' => false
            ));
            return $this;
        }

        $this->sendNotification($email, $text);

        $this->setData(array(
            'result' => true
        ));

        return $this;
    }

    public function sendNotification($email, $text) {
        $host = $_SERVER['HTTP_HOST'];

        $result = $this->getLodDb()->query("SELECT * FROM `users` WHERE `access_level` = 10 AND `confirmed` = '1' AND `admin_confirmed` = '1' AND `ban` = '0'");
        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
            $to = $row['email'];
            $subject = '[League Of Developers] Письмо Администратору через форму обратной связи';

            $message = '
            <html>
            <head>
                <title>League Of Developers. Письмо Администратору через форму обратной связи</title>
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
                            Письмо Администратору через форму обратной связи:
                            <br><br>
                            E-mail пользователя:
                            <br>
                            <a href="mailto:{4}" style="color: #777;">{4}</a>
                            <br><br>
                            Письмо:
                            <br>
                            <div style="background: rgba(91, 165, 160, 0.31); margin-top: 5px; padding: 10px; border-radius: 4px; white-space: pre; border: 1px solid rgba(12, 119, 194, 0.24);color: #3F3F3F;font-size: 14px;word-wrap: break-word;">«{5}»</div>
                            <br><br>
                            <a href="http://{2}/" style="color: #777;">Лига Разработчиков</a>
                        </div>
                    </div>
                    <div style="text-align: center;color: #D2D2D2;">League Of Developers - {3}</div>
                </div>
            </body>
            </html>
            ';
            $message = str_replace(array('{0}', '{1}', '{2}', '{3}', '{4}', '{5}'), array(1, 2, $host, date('Y'), $email, $text), $message);

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

            $headers .= 'From: League Of Developers <notify@lod.misis.ru>' . "\r\n";

            mail($to, $subject, $message, $headers);
        }
    }
}