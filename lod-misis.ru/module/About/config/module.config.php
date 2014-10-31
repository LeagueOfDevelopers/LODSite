<?php

return array(
    'actions' => array(
        'index' => 'index'
    ),
    'module_includes' => array(
        'merge' => array(
            'meta' => array(
                'keywords' => '<meta name="keywords" content="League Of Developers, misis, МИСиС, НИТУ МИСиС, Лига разработчиков, Мисис, НИТУ МИСиС, ios, android, разработка, ПО, яндекс, программисты, найти программистов, работа, студия">',
                'description' => '<meta name="description" content="Цель организации — собрать всех мотивированных и целеустремлённых студентов для того, чтобы вырастить из них IT специалистов. При поддержке Лиги наши студенты работают над реальными или приближенными к реальности проектами разного масштаба, учатся работать в команде и доводить своё дело до конца. Мы проходим путь, который должен пройти каждый разработчик и к концу обучения в институте мы становимся опытными, готовыми к работе специалистами, которых так не хватает на рынке труда.">'
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
                'about' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/main/about'
                        )
                    )
                )
            )
        ),
        'replace' => array(
            'title' => 'О нас | League Of Developers',
            'common_views' => array() 
        )
    )
);