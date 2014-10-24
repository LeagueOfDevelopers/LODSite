<?php

return array(
    'actions' => array(
        'index' => 'index',
        'news' => 'news',
        'save_news' => 'saveNews',
        'delete_news' => 'deleteNews',
        'edit_news' => 'editNews'
    ),
    'module_includes' => array(
        'merge' => array(
            'meta' => array(
                'keywords' => '<meta name="keywords" content="Лига разработчиков, Мисис, НИТУ МИСиС">',
                'description' => '<meta name="description" content="Логово программистов">',
                'noindex' => '<meta name="robots" content="noindex, nofollow"/>'
            ),
            'script' => array(
                'bootstrapValidator',
                'admin'
            ),
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
                'news.content' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'news/content/content'
                        )
                    )
                ),
                'news.news_list' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'news/content/news'
                        )
                    )
                ),
                'news.list' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'news/content/list'
                        )
                    )
                ),
                'news.pagination' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'news/content/pagination/pagination'
                        )
                    )
                ),
                'news.add_news' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'news/add_news/add_news'
                        )
                    )
                ),
                'news.add_news.form' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'news/add_news/form'
                        )
                    )
                ),
                'news.edit_news' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'news/edit_news/edit_news'
                        )
                    )
                ),
                'news.edit_news.form' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'news/edit_news/form'
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