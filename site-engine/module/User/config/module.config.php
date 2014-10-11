<?php

return array(
    'actions' => array(
        'index' => 'index',
        'auth' => 'auth',
        'logout' => 'logout',
        'register' => 'register'
    ),
    'module_includes' => array(
        'merge' => array(
            'meta' => array(
                'keywords' => '<meta name="keywords" content="Лига разработчиков, Мисис, НИТУ МИСиС">',
                'description' => '<meta name="description" content="Логово программистов">'
            ),
            'script' => array(
                'bootstrapValidator',
                'register'
            ),
            'css' => array(
                'bootstrapValidator.min'
            ),
            'module_views' => array(
                'register' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'register/content'
                        )
                    )
                ),
                'navigation' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'register/navigation'
                        )
                    )
                ),
                'register_form' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'register/register_form'
                        )
                    )
                )
            )
        ),
        'replace' => array(
            'title' => 'Регистрация | League Of Developers'
        )
    )
);