<?php

namespace Lod\Orders;

use Lod\Db\LodDatabase;

class OrderItem implements OrderItemInterface {

    private $row;
    private $db;

    /**
     * @param $db LodDatabase
     */
    function __construct(&$db) {
        $this->db = $db;
    }

    public function setTableRow($row) {
        $this->row = $row;
    }

    public function allocateById($order_id) {
        $this->row = $this->db->query("SELECT * FROM `orders` WHERE `id` = ?i", $order_id)->fetch_array(MYSQL_ASSOC);
    }

    public function getObject() {
        return $this->row;
    }

    public function isEmpty() {
        return empty($this->row);
    }

    public function getId() {
        return $this->row ? $this->row['id'] : 0;
    }

    public function getFio() {
        return $this->row ? $this->row['fio'] : "Неизвестно";
    }

    public function getEmail() {
        return $this->row ? $this->row['email'] : null;
    }

    public function getPhone() {
        return $this->row ? $this->row['phone'] : null;
    }

    public function getType() {
        return $this->row ? $this->row['o_type'] : -1;
    }

    public function getFinishTime() {
        $date = $this->row['finish_time'];
        if (empty($date)) {
            return 0;
        }
        $date = explode('.', $date);
        foreach ($date as $i => $el) {
            $date[$i] = intval($el);
        }
        return mktime(0, 0, 0, $date[0], $date[1], $date[2]);
    }

    public function getFinishDate() {
        $time = $this->getFinishTime();
        if (!$time) {
            return 'Не определено';
        }
        return date("d.m.Y в H:i", $time);
    }

    public function getFileLink() {
        return $this->row ? $this->row['attachments'] : null;
    }

    public function getDescription() {
        return $this->row ? $this->row['description'] : null;
    }

    public function getCreateTime() {
        return $this->row ? $this->row['create_time'] : null;
    }

    public function getCreateDate() {
        return date("d.m.Y в H:i", $this->getCreateTime());
    }

    public function setFileLink($link) {
        if (empty($link)) {
            return;
        }
        $order_id = $this->getId();
        if (!is_numeric($order_id)) {
            return;
        }
        $this->db->query("UPDATE `orders` SET `attachments` = ?s WHERE `id` = ?i", $link, $order_id);
        $this->db->query("COMMIT");
        $this->row['attachments'] = $link;
    }

    public function setFinishDate($date) {
        if (empty($date)) {
            return;
        }
        $order_id = $this->getId();
        if (!is_numeric($order_id)) {
            return;
        }
        $this->db->query("UPDATE `orders` SET `finish_time` = ?s WHERE `id` = ?i", $date, $order_id);
        $this->db->query("COMMIT");
        $this->row['finish_time'] = $date;
    }
}