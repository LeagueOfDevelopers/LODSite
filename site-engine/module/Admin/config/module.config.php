<?php

return array(
    'actions' => array(
        'index' => 'index'
    ),
    'module_includes' => array(
        'merge' => array(
            'meta' => array(
                'keywords' => '<meta name="keywords" content="Лига разработчиков, Мисис, НИТУ МИСиС">',
                'description' => '<meta name="description" content="Логово программистов">',
                'noindex' => '<meta name="robots" content="noindex, nofollow"/>'
            ),
            'script' => array(),
            'css' => array(),
            'module_views' => array(
                'content' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/main/main'
                        )
                    )
                )
            )
        ),
        'replace' => array(
            'title' => 'Панель управления | League Of Developers',
            'common_views' => array(
                'head' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'admin/header/header'
                        )
                    )
                )
            ),
            'css' => array(
                'bootstrap.min',
                'bootstrap-theme.min',
                'styles.admin'
            )
        )
    )
);