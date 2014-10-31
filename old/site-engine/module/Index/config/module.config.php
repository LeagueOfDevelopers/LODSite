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
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/main/main'
                        )
                    )
                ),
                'navigation' => array(
                    'authorized_mode' => true,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/navigation/navigation'
                        )
                    )
                ),
                'news' => array(
                    'authorized_mode' => true,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/news/news'
                        )
                    )
                ),
                'pagination' => array(
                    'authorized_mode' => true,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/pagination/pagination'
                        )
                    )
                ),
                'right_block' => array(
                    'authorized_mode' => true,
                    'allocated_paths' => array(
                        array(
                            'range' => array(1, 10),
                            'value' => 'index/right_block/right_block'
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