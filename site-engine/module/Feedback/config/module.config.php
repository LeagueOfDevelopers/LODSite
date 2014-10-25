<?php

return array(
    'actions' => array(
        'index' => 'index',
        'new' => 'new'
    ),
    'module_includes' => array(
        'merge' => array(
            'meta' => array(
                'keywords' => '<meta name="keywords" content="Лига разработчиков, Мисис, НИТУ МИСиС">',
                'description' => '<meta name="description" content="Логово программистов">'
            ),
            'script' => array(
                'feedback',
                'bootstrapValidator'
            ),
            'css' => array(
                'bootstrapValidator.min'
            ),
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
                'feedback' => array(
                    'authorized_mode' => true,
                    'allocated_paths' => array(
                        array(
                            'range' => array(1, 10),
                            'value' => 'index/main/feedback.auth'
                        ),
                        array(
                            'range' => 'default',
                            'value' => 'index/main/feedback'
                        )
                    )
                )
            )
        ),
        'replace' => array(
            'title' => 'Обратная связь | League Of Developers',
            'common_views' => array()
        )
    )
);