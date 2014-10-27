$(document).ready(function() {
    if ($('#registerForm')) {
        $('#registerForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                login: {
                    message: 'Неправильно введен логин',
                    validators: {
                        notEmpty: {
                            message: 'Поле является обязательным и не может быть пустым'
                        },
                        stringLength: {
                            min: 4,
                            max: 50,
                            message: 'Логин должен быть больше 4-х символов'
                        },
                        regexp: {
                            regexp: /^[a-z][0-9a-z_]{3,50}$/i,
                            message: 'Логин должен должен состоять из латинских букв, цифр и нижнего подчеркивания. Первый символ всегда латинский.'
                        },
                        remote: {
                            message: 'Логин уже существует или указан некорректно',
                            url: '/user/checklogin'
                        }
                    }
                },
                first_name: {
                    message: 'Неправильно введено имя',
                    validators: {
                        notEmpty: {
                            message: 'Поле является обязательным и не может быть пустым'
                        },
                        stringLength: {
                            min: 3,
                            max: 30,
                            message: 'Имя должно быть больше 3-х и меньше 30-ти символов'
                        },
                        regexp: {
                            regexp: /^[а-я]+$/i,
                            message: 'Имя может состоять только из русского алфавита'
                        }
                    }
                },
                last_name: {
                    message: 'Неправильно введена фамилия',
                    validators: {
                        notEmpty: {
                            message: 'Поле является обязательным и не может быть пустым'
                        },
                        stringLength: {
                            min: 2,
                            max: 30,
                            message: 'Фамилия должна быть больше 2-х и меньше 30-ти символов'
                        },
                        regexp: {
                            regexp: /^[а-я]+$/i,
                            message: 'Фамилия может состоять только из русского алфавита'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Поле является обязательным и не может быть пустым'
                        },
                        regexp: {
                            regexp: /^[-a-z0-9!#$%&'*+/=?^_`{|}~]+(\.[-a-z0-9!#$%&'*+/=?^_`{|}~]+)*@([a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)+(aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/i,
                            message: 'Указан некорректный e-mail адрес'
                        },
                        remote: {
                            message: 'Такой e-mail уже используется или указан некорректно',
                            url: '/user/checkemail'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Введите пароль'
                        },
                        stringLength: {
                            min: 6,
                            message: 'Не меньше 6-ти символов'
                        },
                        different: {
                            field: 'login',
                            message: 'Пароль не должен быть таким же как Логин'
                        }
                    }
                },
                passwordagain: {
                    validators: {
                        notEmpty: {
                            message: 'Введите повторно пароль'
                        },
                        stringLength: {
                            min: 6,
                            message: 'Не меньше 6-ти символов'
                        },
                        callback: {
                            message: 'Повторный пароль не совпадает с введенным паролем',
                            callback: function(value, validator) {
                                var item = gebi('register_password');
                                return value == item.value;
                            }
                        }
                    }
                },
                sex: {
                    message: 'Выберите пол',
                    validators: {
                        notEmpty: {
                            message: 'Поле является обязательным и не может быть пустым'
                        }
                    }
                },
                vk_profile: {
                    message: 'Вставьте ссылку на свой профиль',
                    validators: {
                        notEmpty: {
                            message: 'Поле является обязательным и не может быть пустым'
                        },
                        regexp: {
                            regexp: /^(http:\/\/|https:\/\/)(www\.)*vk\.com\/[a-z0-9._]{2,100}$/i,
                            message: 'Некорректная ссылка'
                        }
                    }
                },
                github_account: {
                    message: 'Введите логин от GitHub',
                    validators: {
                        notEmpty: {
                            message: 'Вам необходимо иметь аккаунт на GitHub'
                        },
                        regexp: {
                            regexp: /^[0-9a-z_]{2,50}$/i,
                            message: 'Аккаунт введен некорректно'
                        }
                    }
                },
                phone: {
                    message: 'Введите номер телефона',
                    validators: {
                        notEmpty: {
                            message: 'Введите номер телефона для связи'
                        },
                        regexp: {
                            regexp: /^\+?[0-9]{1,4}\s?\(?[0-9]{3}\)?(\s)?[0-9]{3}(\s|\-)?[0-9]{2}(\s|\-)?[0-9]{2}$/,
                            message: 'Телефонный номер введен некорректно'
                        }
                    }
                },
                skype: {
                    message: 'Введите логин от Skype',
                    validators: {
                        regexp: {
                            regexp: /^[0-9a-z_-]{2,50}$/i,
                            message: 'Логин введен некорректно'
                        }
                    }
                },
                faculty: {
                    message: 'Введите название вашей Кафедры',
                    validators: {
                        regexp: {
                            regexp: /^[a-zA-Zа-яА-ЯёЁ.,;\-_0-9 ]+$/i,
                            message: 'Название введено некорректно'
                        }
                    }
                },
                university_group: {
                    message: 'Введите название вашей группы',
                    validators: {
                        regexp: {
                            regexp: /^[a-zA-Zа-яА-ЯёЁ.,;\-_0-9 ]+$/i,
                            message: 'Название введено некорректно'
                        }
                    }
                },
                enrollment_year: {
                    message: 'Выберите год',
                    validators: {
                        regexp: {
                            regexp: /^[0-9]{4}$/i,
                            message: 'Некорректный год'
                        }
                    }
                },
                about: {
                    message: 'Напишите о себе',
                    validators: {
                        regexp: {
                            regexp: /^[a-zA-Zа-яА-ЯёЁ.,;\-_0-9 =]+$/i,
                            message: 'Некорректное поле'
                        }
                    }
                }
            }
        });
    }

    if ($('#resetPasswordForm')) {
        $('#resetPasswordForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                email: {
                    validators: {
                        notEmpty: {
                            message: 'Поле является обязательным и не может быть пустым'
                        },
                        regexp: {
                            regexp: /^[-a-z0-9!#$%&'*+/=?^_`{|}~]+(\.[-a-z0-9!#$%&'*+/=?^_`{|}~]+)*@([a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)+(aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/i,
                            message: 'Указан некорректный e-mail адрес'
                        }
                    }
                }
            }
        });
    }

    if ($('#newPasswordForm')) {
        $('#newPasswordForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                new_password: {
                    validators: {
                        identical: {
                            field: 'new_password_confirm',
                            message: 'Пароли должны совпадать'
                        },
                        stringLength: {
                            min: 6,
                            max: 128,
                            message: 'Новый пароль должен быть больше 6 символов'
                        },
                        notEmpty: {
                            message: 'Поле является обязательным и не может быть пустым'
                        }
                    }
                },
                new_password_confirm: {
                    validators: {
                        identical: {
                            field: 'new_password',
                            message: 'Пароли должны совпадать'
                        }
                    }
                }
            }
        });
    }
});