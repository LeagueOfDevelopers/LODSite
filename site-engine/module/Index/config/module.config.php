<?php

return array(
    'actions' => array(
        'index' => 'index'
    ),
    'module_includes' => array(
        'merge' => array(
            'meta' => array(
                'keywords' => '<meta name="keywords" content="Лига разработчиков, Мисис, НИТУ МИСиС">',
                'description' => '<meta name="description" content="Логово программистов">'
            ),
            'script' => array(),
            'css' => array(),
            'module_views' => array(
                'content' => array(
                    'authorized_mode' => true,
                    'allocated_paths' => array(
                        array(
                            'range' => array(1, 2),
                            'value' => 'index/main'
                        ),
                        array(
                            'range' => array(3, 5),
                            'value' => 'index/main_dev'
                        ),
                        array(
                            'range' => array(6, 8),
                            'value' => 'index/main_manager'
                        ),
                        array(
                            'range' => array(9, 10),
                            'value' => 'index/main_admin'
                        ),
                        array(
                            'range' => 'default',
                            'value' => 'index/main'
                        )
                    )
                )
            )
        ),
        'replace' => array(
            'title' => 'Главная страница',
            'common_views' => array(
                'head2' => array(
                    'authorized_mode' => true,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'common/head/head'
                        )
                    )
                )
            )
        )
    )
);