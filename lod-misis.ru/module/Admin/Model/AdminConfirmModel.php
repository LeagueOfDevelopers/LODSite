<?php

namespace Admin\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class AdminConfirmModel extends AbstractModel {

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if ($user->isAuth() && $user->getAccessLevel() == 10) {
            $data = Application::$request_variables['post'];

            $user_id = $data['id'];

            if (!$user_id || !is_numeric($user_id)) {
                $this->setData(array(
                    'result' => false
                ));
                return $this;
            }

            $cur_user = new User($this->getLodDb());
            $cur_user->allocateUserById($user_id);
            $cur_user->setAdminConfirm();
            $cur_user->setAccessLevel(5);

            $this->sendNotificationToUser($cur_user);

            $this->setData(array(
                'result' => true
            ));
        } else {
            $this->setData(array(
                'result' => false
            ));
        }

        return $this;
    }

    /**
     * @param $cur_user User
     */
    private function sendNotificationToUser($cur_user) {
        $host = $_SERVER['HTTP_HOST'];

        $to = $cur_user->getEmail();
        $subject = '[League Of Developers] Заявка успешно принята';

        $message = '
            <html>
            <head>
                <title>League Of Developers. Заявка успешно принята</title>
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
                            Поздравляем!
                            <br><br>
                            Ваша заявка в Лигу Разработчиков успешно принята Администраторами. Вы можете зайти в свой аккаунт, пользуясь меню сверху.<br>
                            <a href="http://{2}/" title="Главная страница" style="color: #777;">http://{2}/</a>
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