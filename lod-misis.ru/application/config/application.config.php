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
                'yandex.metrika' => '<script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter26889786 = new Ya.Metrika({id:26889786, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="//mc.yandex.ru/watch/26889786" style="position:absolute; left:-9999px;" alt="" /></div></noscript>'
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