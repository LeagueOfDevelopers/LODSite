<?php

return array(
    'actions' => array(
        'index' => 'index',
        'auth' => 'auth',
        'logout' => 'logout',
        'register' => 'register',
        'signup' => 'signUp',
        'checklogin' => 'checkLogin',
        'checkemail' => 'checkEmail',
        'confirm' => 'confirmAccount',
        'resetPassword' => 'resetPassword',
        'act_reset_password' => 'actResetPassword',
        'new_password' => 'newPassword',
        'set_new_password' => 'setNewPassword'
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
                ),
                'register.success' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'register.success/register.success'
                        )
                    )
                ),
                'register.confirmed' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'register.confirmed/register.confirmed'
                        )
                    )
                ),
                'reset_password.main' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'reset_password/main'
                        )
                    )
                ),
                'reset_password.navigation' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'reset_password/navigation'
                        )
                    )
                ),
                'reset_password.form' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'reset_password/form'
                        )
                    )
                ),
                'new_password.main' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'new_password/main'
                        )
                    )
                ),
                'new_password.navigation' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'new_password/navigation'
                        )
                    )
                ),
                'new_password.form' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'new_password/form'
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