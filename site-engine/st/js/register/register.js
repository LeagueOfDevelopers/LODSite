$(document).ready(function() {
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
                        regexp: /^[а-яА-Я]+$/,
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
                        regexp: /^[а-яА-Я]+$/,
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
                        regexp: /^[-a-z0-9!#$%&'*+/=?^_`{|}~]+(\.[-a-z0-9!#$%&'*+/=?^_`{|}~]+)*@([a-z0-9]([-a-z0-9]{0,61}[a-z0-9])?\.)*(aero|arpa|asia|biz|cat|com|coop|edu|gov|info|int|jobs|mil|mobi|museum|name|net|org|pro|tel|travel|[a-z][a-z])$/i,
                        message: 'Указан некорректный e-mail адрес'
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
                    }
                }
            }
        }
    });
});