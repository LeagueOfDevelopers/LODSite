<?php

return array(
    'actions' => array(
        'index' => 'index',
        'news' => 'news',
        'orders' => 'orders',
        'save_news' => 'saveNews',
        'delete_news' => 'deleteNews',
        'edit_news' => 'editNews',
        'users' => 'users',
        'save_user_category' => 'saveUserCategory',
        'signin_by_user' => 'signInByUser',
        'toggle_ban' => 'toggleBan',
        'admin_confirm' => 'adminConfirm'
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
                ),
                'common.menu' => array(
                    'authorized_mode' => true,
                    'allocated_paths' => array(
                        array(
                            'range' => array(8, 9),
                            'value' => 'common/menu.manager'
                        ),
                        array(
                            'range' => array(10, 10),
                            'value' => 'common/menu.admin'
                        ),
                        array(
                            'range' => 'default',
                            'value' => 'common/menu'
                        )
                    )
                ),
                'users.content' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'users/content/content'
                        )
                    )
                ),
                'users.users_list' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'users/content/users_list'
                        )
                    )
                ),
                'users.pagination' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'users/pagination/pagination'
                        )
                    )
                ),
                'users.edit' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'users/edit/form'
                        )
                    )
                ),
                'users.new_users' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'users/content/new_users'
                        )
                    )
                ),
                'orders.content' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'orders/content/content'
                        )
                    )
                ),
                'orders.list' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'orders/content/orders_list'
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