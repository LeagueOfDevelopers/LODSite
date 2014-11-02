<?php

return array(
    'actions' => array(
        'index' => 'index',
        'add_comment' => 'addComment',
        'delete_comment' => 'deleteComment'
    ),
    'module_includes' => array(
        'merge' => array(
            'meta' => array(
                'keywords' => '<meta name="keywords" content="League Of Developers, misis, МИСиС, НИТУ МИСиС, Лига разработчиков, Мисис, НИТУ МИСиС, ios, android, разработка, ПО, яндекс, программисты, найти программистов, работа, студия">',
                'description' => '<meta name="description" content="Новости сайта Лиги Разработчиков НИТУ МИСиС">'
            ),
            'script' => array(
                'bootstrapValidator',
                'news'
            ),
            'css' => array(),
            'module_views' => array(
                'main' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/main/main'
                        )
                    )
                ),
                'news.navigation' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/navigation/navigation'
                        )
                    )
                ),
                'news.content' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/content/content'
                        )
                    )
                ),
                'news.header' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/header/header'
                        )
                    )
                ),
                'news.noauth' => array(
                    'authorized_mode' => true,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/comments/noauth'
                        ),
                        array(
                            'range' => array(1, 10),
                            'value' => 'index/comments/auth'
                        )
                    )
                ),
                'news.comments' => array(
                    'authorized_mode' => true,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/comments/comments'
                        ),
                        array(
                            'range' => array(1,10),
                            'value' => 'index/comments/comments.auth'
                        )
                    )
                ),
                'news.add_comment' => array(
                    'authorized_mode' => true,
                    'allocated_paths' => array(
                        array(
                            'range' => array(1, 10),
                            'value' => 'index/comments/add_comment'
                        )
                    )
                ),
                'news.right_block' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/right_block/right'
                        )
                    )
                )
            )
        ),
        'replace' => array(
            'title' => 'Главная страница',
            'common_views' => array()
        )
    )
);