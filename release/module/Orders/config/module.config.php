<?php

return array(
    'actions' => array(
        'index' => 'index',
        'add_order' => 'addOrder',
        'success'=> 'success'
    ),
    'module_includes' => array(
        'merge' => array(
            'meta' => array(
                'keywords' => '<meta name="keywords" content="League Of Developers, misis, МИСиС, НИТУ МИСиС, Лига разработчиков, Мисис, НИТУ МИСиС, ios, android, разработка, ПО, яндекс, программисты, найти программистов, работа, студия">',
                'description' => '<meta name="description" content="Это сайт Лиги Разработчиков! У Вас есть интересная идея, но Вы не представляете как ее реализовать? Мы вам поможем!">'
            ),
            'script' => array(
                'bootstrapValidator',
                'orders'
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
                'orders' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/main/orders'
                        )
                    )
                ),
                'success.content' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/success/main'
                        )
                    )
                )
            )
        ),
        'replace' => array(
            'title' => 'Стол заказов | League Of Developers',
            'common_views' => array() 
        )
    )
);