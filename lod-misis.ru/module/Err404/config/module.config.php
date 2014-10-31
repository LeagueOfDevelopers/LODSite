<?php

return array(
    'actions' => array(
        'index' => 'index'
    ),
    'module_includes' => array(
        'merge' => array(
            'meta' => array(
                'keywords' => '<meta name="keywords" content="Мисис, библиотека, скачать, пособия, электронная библиотека, онлайн">',
                'description' => '<meta name="description" content="Онлайн версия скачивателя материалов из электронной библиотеки НИТУ МИСиС. Никаких авторизаций. Быстрый доступ к материалам в любое время суток. Вы можете скачать в любой момент материалы библиотеки прямо с Ваших мобильных устройств и пользоваться ими на своих парах.">'
            ),
            'module_views' => array(
                'content' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/404'
                        )
                    )
                ),
                'error' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/error'
                        )
                    )
                )
            )
        ),
        'replace' => array(
            'title' => 'Страницы не существует'
        )
    )
);