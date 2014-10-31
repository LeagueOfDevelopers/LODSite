<?php

return array(
    'actions' => array(
        'index' => 'index'
    ),
    'module_includes' => array(
        'merge' => array(
            'meta' => array(
                'keywords' => '<meta name="keywords" content="League Of Developers, misis, МИСиС, НИТУ МИСиС, Лига разработчиков, Мисис, НИТУ МИСиС, ios, android, разработка, ПО, яндекс, программисты, найти программистов, работа, студия">',
                'description' => '<meta name="description" content="Мы — студенты НИТУ МИСиС, выбравшие IT в качестве сферы профессионального развития. В Лиге Разработчиков мы работаем над программными проектами в таких сферах как: веб, мобильные платформы, десктоп, серверные приложения, игры. Мы не ограничиваем себя и не стоим на месте, постоянно развиваемся и ищем новые сферы применения своих способностей.">'
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
            'title' => 'Лига Разработчиков НИТУ МИСиС',
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