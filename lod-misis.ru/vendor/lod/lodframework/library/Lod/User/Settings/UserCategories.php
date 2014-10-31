<?php

namespace Lod\User\Settings;

class UserCategories {

    /* Don't change the access level of users. */
    public static $categories = array(
        'default' => array(
            'color' => '#ccc',
            'value' => 'Не определено'
        ),
        '1' => array(
            'color' => '#428BCA',
            'background' => 'rgba(42, 84, 172, 0.11)',
            'value' => 'Гость'
        ),
        '5' => array(
            'color' => '#FFF',
            'background' => 'rgba(29, 154, 37, 0.66)',
            'value' => 'Разработчик'
        ),
        '8' => array(
            'color' => '#FFF',
            'background' => '#50B7B9',
            'value' => 'Менеджер'
        ),
        '10' => array(
            'color' => '#FFF',
            'background' => '#e67e22',
            'value' => 'Администратор'
        )
    );

    public static function defineCategoryName($access_level) {
        return self::defineCategory($access_level)['value'];
    }

    public static function defineCategoryColor($access_level) {
        return self::defineCategory($access_level)['color'];
    }

    public static function defineCategoryBackground($access_level) {
        return self::defineCategory($access_level)['background'];
    }

    private static function defineCategory($access_level) {
        $categories = self::$categories;
        if (!is_numeric($access_level) || !array_key_exists((string)$access_level, $categories)) {
            return $categories['default'];
        }
        return $categories[(string)$access_level];
    }
}