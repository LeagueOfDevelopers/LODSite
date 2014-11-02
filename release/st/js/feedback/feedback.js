$(document).ready(function() {
    $('#feedbackForm').bootstrapValidator({
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
            },
            text: {
                message: 'Текста нет',
                validators: {
                    notEmpty: {
                        message: 'Поле является обязательным и не может быть пустым'
                    }
                }
            }
        }
    });
});

var Feedback = {
    send: function() {
        var email = document.getElementsByName('email')[0].value;
        var text = document.getElementsByName('text')[0].value;
        var obj = {};
            obj.url = "http://" + window.location.host + "/feedback/new";
            obj.data = {
                email: email,
                text: text
            };
        Ajax.post(obj, Feedback.sendRequestHandler);
    },
    sendRequestHandler: function(res) {
        if (res.result) {
            var form = $('#feedbackForm');
            form.slideUp(100);
            $('#success-feedback-send').slideDown(100);
            document.getElementsByName('text')[0].value = '';
        }
    }
};