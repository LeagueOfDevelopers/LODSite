<?php

return array(
    'actions' => array(
        'index' => 'index',
        'edit' => 'edit',
        'save_modified' => 'saveModified',
        'upload_image' => 'uploadProfileImage',
        'changePassword' => 'changePassword',
        'save_new_password' => 'saveNewPassword'
    ),
    'module_includes' => array(
        'merge' => array(
            'meta' => array(
                'keywords' => '<meta name="keywords" content="Лига разработчиков, Мисис, НИТУ МИСиС">',
                'description' => '<meta name="description" content="Логово программистов">'
            ),
            'script' => array(
                'bootstrapValidator',
                'edit',
                'ajaxupload',
                'profile'
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
                'profile.container' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/main/container'
                        )
                    )
                ),
                'navigation' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/main/navigation'
                        )
                    )
                ),
                'user.header' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/user/header'
                        )
                    )
                ),
                'user.actions' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/user/actions'
                        )
                    )
                ),
                'user.info' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/user/info'
                        )
                    )
                ),
                'user.about' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/user/about'
                        )
                    )
                ),
                'right_block' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/right_block/right'
                        )
                    )
                ),
                'recent_activity_users' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'index/right_block/users.list'
                        )
                    )
                ),
                'edit.main' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'edit/main/content'
                        )
                    )
                ),
                'edit.container' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'edit/main/container'
                        )
                    )
                ),
                'edit.navigation' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'edit/inner/navigation'
                        )
                    )
                ),
                'edit.header' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'edit/inner/header'
                        )
                    )
                ),
                'edit.form' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'edit/inner/edit_form'
                        )
                    )
                ),
                'edit.success' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'edit/states/success'
                        )
                    )
                ),
                'change_password.main' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'change_password/main'
                        )
                    )
                ),
                'change_password.navigation' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'change_password/navigation'
                        )
                    )
                ),
                'change_password.form' => array(
                    'authorized_mode' => false,
                    'allocated_paths' => array(
                        array(
                            'range' => 'default',
                            'value' => 'change_password/form'
                        )
                    )
                )
            )
        ),
        'replace' => array(
            'title' => 'Профиль | League Of Developers',
            'common_views' => array()
        )
    )
);