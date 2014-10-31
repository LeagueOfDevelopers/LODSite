<?php

namespace Lod\Orders;

use Lod\Db\LodDatabase;

class Orders {

    private $db;

    /**
     * @param $db LodDatabase
     */
    function __construct(&$db) {
        $this->db = $db;
    }

    public function addOrder($data) {
        $this->db->query(
            "INSERT INTO `orders` (`fio`, `email`, `phone`, `o_type`, `description`, `create_time`)
            VALUES(?s, ?s, ?s, ?i, ?s, ?i)",
            $data['name'], $data['email'], $data['phone'], intval($data['type']), $data['description'], time()
        );
        $inserted_id = $this->db->getDriver()->insert_id;
        $this->db->query("COMMIT");
        return $inserted_id;
    }

    public function getOrders($count = 20, $offset = 0, $sort = DESC) {
        $sort_type = $sort == DESC ? 'DESC' : 'ASC';
        $result = $this->db->query(
            "SELECT *
            FROM `orders`
            ORDER BY `id` $sort_type
            LIMIT ?i, ?i",
            $offset, $count
        );
        $orders_list = array();
        while ($row = $result->fetch_array(MYSQL_ASSOC)) {
            $order = new OrderItem($this->db);
            $order->setTableRow($row);
            array_push($orders_list, $order);
        }
        return $orders_list;
    }
}