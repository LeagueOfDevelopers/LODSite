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
            $confirmed = true;
        }
        $this->setData(array(
            'result' => $confirmed
        ));

        return $this;
    }
}