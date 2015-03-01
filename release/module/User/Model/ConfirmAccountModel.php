<?php

namespace User\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\Authorization;

class ConfirmAccountModel extends AbstractModel {

    public function main() {
        $key = Application::$request_variables['get']['key'];
        $id = Application::$request_variables['get']['id'];

        $result = $this->getLodDb()->query("SELECT * FROM `users` WHERE `id` = ?i AND `confirm_key` = ?s AND `confirmed` = '0'", $id, $key);
        $confirmed = false;
        if ($result->num_rows) {
            $this->getLodDb()->query("UPDATE `users` SET `confirmed` = '1' WHERE `id` = ?i", $id);
            $this->getLodDb()->query("COMMIT");
            $this->sendNotificationToAdmins();
            $confirmed = true;
        }
        $this->setData(array(
            'result' => $confirmed
        ));

        return $this;
    }

    private function sendNotificationToAdmins() {
        $host = $_SERVER['HTTP_HOST'];

        $result = $this->getLodDb()->query("SELECT * FROM `users` WHERE `access_level` = 10 AND `ban` = '0'");
        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
            $to = $row['email'];
            $subject = '[League Of Developers] Новая заявка в Лигу Разработчиков';

            $message = '
            <html>
            <head>
                <title>League Of Developers. Заявка в Лигу Разработчиков</title>
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
                            Для того, чтобы посмотреть заявку, пройдите по ссылке:<br>
                            <a href="http://{2}/adminium/users" title="Панель Управления" style="color: #777;">http://{2}/adminium/users</a>
                        </div>
                    </div>
                    <div style="padding: 10px 0;text-align: center;color: #777;">Если вы не знаете что это за письмо, просто проигнорируйте его.</div>
                    <div style="text-align: center;color: #D2D2D2;">League Of Developers - {3}</div>
                </div>
            </body>
            </html>
            ';
            $message = str_replace(array('{0}', '{1}', '{2}', '{3}'), array(1, 2, $host, date('Y')), $message);

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

            $headers .= 'From: League Of Developers <notify@lod.misis.ru>' . "\r\n";

            mail($to, $subject, $message, $headers);
        }
    }
}