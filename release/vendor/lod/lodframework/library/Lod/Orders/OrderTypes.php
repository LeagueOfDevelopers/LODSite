<?php

namespace Lod\Orders;

class OrderTypes {

    public static $types = array(
        '1' => 'Верстка/макет сайта',
        '2' => 'Сайт',
        '3' => 'Мобильное приложение Android/iOS/WP',
        '4' => 'Desktop-приложение',
        '5' => 'Другое'
    );

    public static function getNameById($type_id) {
        return self::$types[(string)$type_id];
    }
}