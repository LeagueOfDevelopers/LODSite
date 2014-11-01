<?php

namespace Lod\User\Settings;

class UserCategories {

    private static $categories = array(
        'default' => array(
            'color' => '#ccc',
            'value' => 'Не определено'
        ),
        '0' => array(
            'color' => '#ccc',
            'value' => 'Гость'
        ),
        '1' => array(
            'color' => '#777',
            'value' => 'Пользователь'
        ),
        '5' => array(
            'color' => '#777',
            'value' => 'Разработчик'
        ),
        '8' => array(
            'color' => '#777',
            'value' => 'Менеджер'
        ),
        '10' => array(
            'color' => '#d00',
            'value' => 'Администратор'
        )
    );

    public static function defineCategoryName($access_level) {
        return self::defineCategory($access_level)['value'];
    }

    public static function defineCategoryColor($access_level) {
        return self::defineCategory($access_level)['color'];
    }

    private static function defineCategory($access_level) {
        $categories = self::$categories;
        if (!is_numeric($access_level) || !array_key_exists((string)$access_level, $categories)) {
            return $categories['default'];
        }
        return $categories[(string)$access_level];
    }
}