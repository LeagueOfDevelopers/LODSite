<?php

namespace Admin\Model;

use Lod\Core\Application;
use Lod\Core\Model\AbstractModel;
use Lod\Orders\Orders;
use Lod\User\Authorization\CheckAuthorization;
use Lod\User\User;

class OrdersModel extends AbstractModel {

    private $user;

    public function main() {
        $check_auth = new CheckAuthorization($this->getLodDb());
        $check_auth->check();

        $user = new User($this->getLodDb(), $check_auth->getUserRow());
        $user->setCheckAuthorization($check_auth);

        if ($user->getAccessLevel() < 8) {
            Application::toRoute('/');
            Application::stop();
        }

        $this->user = $user;

        $orders = new Orders($this->getLodDb());
        $orders_list = $orders->getOrders(100);
        $this->setData(array(
            'user' => $user,
            'orders' => $orders_list
        ));

        return $this;
    }
}