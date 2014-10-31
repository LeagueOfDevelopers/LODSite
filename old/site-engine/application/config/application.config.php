<?php

return array(
    'modules' => array(
        '404' => 'Err404',
        'index' => 'Index',
        'user' => 'User',
        'profile' => 'Profile',
        'feedback' => 'Feedback',
        'about' => 'About',
        'news' => 'News',
        'adminium' => 'Admin',
        'forum' => 'Forum',
        'portfolio' => 'Portfolio',
        'orders' => 'Orders'
    ),
    'module_options' => array(
        'module_path' => '/module'
    ),
    'vendor_options' => array(
        'vendor_path' => '/vendor',
        'projects' => array(
            'lod' => array(
                'base_path' => '/lod/lodframework',
                'library_path' => '/lod/lodframework/library'
            )
        )
    ),
    'views_options' => array(
        'views_path' => '/vendor/lod/lodframework/resources/layout',
        'common_includes' => array(
            'title' => 'Лига Разработчиков',
            'meta' => array(
                'charset' => '<meta http-equiv="content-type" content="text/html; charset=utf-8">',
                'ie' => '<meta http-equiv="X-UA-Compatible" content="IE=edge">',
                'noindex' => '<meta name="robots" content="noindex, nofollow"/>'
            ),
            'script' => array(
                'jquery',
                'bootstrap.min',
                'library',
                'user'
            ),
            'css' => array(
                'bootstrap.min',
                'bootstrap-theme.min',
                'styles'
            ),
            'icon' => array(
                'favicon'
            ),
            'views' => array(
                'head' => array(
                    'authorized_mode' => true,
                    'allocated_paths' => array(
                        array(
                            'range' => array(1, 4),
                            'value' => 'common/head/head.auth'
                        ),
                        array(
                            'range' => array(5, 7),
                            'value' => 'common/head/head.auth.member'
                        ),
                        array(
                            'range' => array(8, 10),
                            'value' => 'common/head/head.auth.admin'
                        ),
                        array(
                            'range' => 'default',
                            'value' => 'common/head/head'
                        )
                    )
                ),
                'footer' => array(
                    'authorized_mode' => true,
                    'allocated_paths' => array(
                        array(
                            'range' => array(1, 10),
                            'value' => 'common/footer/footer.auth'
                        ),
                        array(
                            'range' => 'default',
                            'value' => 'common/footer/footer'
                        )
                    )
                )
            )
        )
    ),
    'resource_options' => array(
        'path' => '/application/resources/global.php'
    ),
    'db_options' => require Q_PATH.'/application/config/db.config.php'
);

/*
'views' => array(
    'head' => array(
        'authorized_mode' => true,
        'allocated_paths' => array(
            array(
                'range' => 'default',
                'value' => 'common/head/head'
            ),
            array(
                'range' => array(1, 2),
                'value' => 'common/footer/footer'
            )
        )
    ),
    'footer' => array(
        'authorized_mode' => false,
        'allocated_paths' => array(
            array(
                'range' => 'default',
                'value' => 'common/footer/footer'
            )
        )
    )
)
*/