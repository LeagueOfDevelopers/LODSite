<?php

namespace Orders\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\Orders\OrderItem;
use Lod\Orders\Orders;
use Lod\User\Validator\FieldsValidator;

class AddOrderModel extends AbstractModel {

    public function main() {
        $data = Application::$request_variables['post'];
        $file = $_FILES['attachment'];
        $flag = true;

        $validator = new FieldsValidator();
        if (!$validator->isEmailValid($data['email'])) {
            $flag = false;
        }
        if (!$validator->isPhoneNumberValid($data['phone'])) {
            $flag = false;
        }

        if (!$flag) {
            Application::toRoute('/orders?failed');
            Application::stop();
        }

        $file_link = $this->saveAndGet($file);

        $orders = new Orders($this->getLodDb());
        $inserted_id = $orders->addOrder($data);

        $order = new OrderItem($this->getLodDb());
        $order->allocateById($inserted_id);
        $order->setFileLink($file_link);
        $order->setFinishDate($data['deadline']);

        $this->sendNotification();

        Application::toRoute('/orders/success');
        Application::stop();

        return $this;
    }

    private function saveAndGet($file) {
        $extension = end(explode('.', $file['name']));
        $host = $_SERVER['HTTP_HOST'];
        $relative_path = '/st/ords/attachments/';
        $name = md5(mktime().rand(1, 1e9));
        $file_name = 'http://'.$host.$relative_path.$name.'.'.$extension;

        if (is_uploaded_file($file['tmp_name'])) {
            if (copy($file['tmp_name'], Q_PATH.$relative_path.$name.'.'.$extension)) {
                return $file_name.'?'.rand(10000,99000);
            }
        }
        return null;
    }

    private function sendNotification() {
        $host = $_SERVER['HTTP_HOST'];

        $result = $this->getLodDb()->query("SELECT * FROM `users` WHERE `access_level` = 10 AND `confirmed` = '1' AND `admin_confirmed` = '1' AND `ban` = '0'");
        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
            $to = $row['email'];
            $subject = '[League Of Developers] (!) Новый заказ';

            $message = '
            <html>
            <head>
                <title>League Of Developers. Важно. Один новый заказ.</title>
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
                            Создан новый заказ!
                            <br>
                            <br>
                            Для того, чтобы посмотреть список заказов, пройдите по ссылке:
                            <br>
                            <a href="http://{2}/adminium/orders" style="color: #777;">http://{2}/adminium/orders</a>
                        </div>
                    </div>
                    <br>
                    <div style="text-align: center;color: #D2D2D2;">League Of Developers - {3}</div>
                </div>
            </body>
            </html>
            ';
            $message = str_replace(array('{0}', '{1}', '{2}', '{3}'), array(1, 2, $host, date('Y')), $message);

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

            $headers .= 'From: League Of Developers <notify@lod.misis.ru>' . "\r\n";

            mail($to, $subject, $message, $headers);
        }
    }
}