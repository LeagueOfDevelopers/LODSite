<?php

return array(
    'actions' => array(
        'index' => 'index',
        'person' =>'person',
        'showCartProject' => 'showCartProject'
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
                'portfolio.container' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/main/container'
                        )
                    )
                ),
                'showcart' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'cart/cart'
                        )
                    )
                ),
                'person.main' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'person/main/content'
                        )
                    )
                ),
                'person.container' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'person/main/container'                            )
                        )
                    )
            )
        ),
        'replace' => array(
            'title' => 'Портфолио Лиги Разработчиков | League Of Developers',
            'common_views' => array() 
        )
    )
);