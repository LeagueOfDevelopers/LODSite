$(document).ready(function() {
    if ($('#orderForm')) {
        $('#orderForm').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                name: {
                    message: 'Некорректное поле',
                    validators: {
                        notEmpty: {
                            message: 'Поле является обязательным и не может быть пустым'
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
                type: {
                    message: 'Выберите тип',
                    validators: {
                        callback: {
                            message: 'Выберите тип',
                            callback: function (value, validator, $field) {
                                return value != -1;
                            }
                        }
                    }
                },
                deadline: {
                    message: 'Введите корректную дату',
                    validators: {
                        regexp: {
                            regexp: /^\d{1,2}\.\d{1,2}\.\d{4}\s*$/,
                            message: 'Дата введена некорректно'
                        }
                    }
                },
                description: {
                    message: 'Введите описание',
                    validators: {
                        notEmpty: {
                            message: 'Введите описание заказа'
                        }
                    }
                }
            }
        });
    }
});