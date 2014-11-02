$(document).ready(function() {
    $('#addNewsForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            title: {
                validators: {
                    notEmpty: {
                        message: 'Вы не написали заголовок'
                    }
                }
            },
            preview_text: {
                validators: {
                    notEmpty: {
                        message: 'Вы не написали превью текст'
                    }
                }
            },
            text: {
                validators: {
                    notEmpty: {
                        message: 'Вы не написали текст'
                    }
                }
            },
            photo: {
                validators: {
                    regexp: {
                        regexp: /^((http|https)\:\/\/(www\.)?[^\r\n\t\f ]*)\s?$/i,
                        message: 'Некорректная ссылка'
                    }
                }
            }
        }
    });
});

var Admin = {
    attachImageLink: function() {
        var news_field = gebi('text_add_news');
        var link = prompt("Вставьте ссылку на изображение");
        link && (news_field.value += (news_field.value.length ? ' ' : '') + '['+link+'] ');
        var end = news_field.value.length;
        news_field.setSelectionRange(end, end);
    },
    attachLink: function() {
        var news_field = gebi('text_add_news');
        var link = prompt("Вставьте ссылку");
        link && (news_field.value += (news_field.value.length ? ' ' : '') +link+' ');
        var end = news_field.value.length;
        news_field.setSelectionRange(end, end);
    },
    addNews: function() {
        var fields = $('#addNewsForm input');
        var data = {};
        var k = 0;
        try {
            for (var field in fields) {
                if (!fields.hasOwnProperty(field)) continue;
                k++;
                if (k > 2)
                    break;
                data[fields[field].name] = fields[field].value;
            }
            var textareas = $('#addNewsForm textarea');
            data[textareas[0].name] = textareas[0].value;
            data[textareas[1].name] = textareas[1].value;
            var obj = {};
                obj.url = "http://" + window.location.host + "/adminium/save_news";
                obj.data = data;
            Ajax.post(obj, Admin.addNewsRequestHandler);
        } catch (err) {
            alert(err.toString);
        }
    },
    addNewsRequestHandler: function(res) {
        if (res.result) {
            window.refresh('/adminium/news');
        }
    },
    deleteNews: function(news_id) {
        var result = confirm("Вы действительно хотите удалить эту новость?");
        if (!result) {
            return;
        }
        var obj = {};
            obj.url = "http://" + window.location.host + "/adminium/delete_news";
            obj.data = {
                'id': news_id
            };
        Ajax.post(obj, Admin.deleteNewsRequestHandler);
    },
    deleteNewsRequestHandler: function(res) {
        if (res.result) {
            window.refresh('/adminium/news');
        }
    },
    editNews: function(news_id) {
        var fields = $('#addNewsForm input');
        var data = {};
        var k = 0;
        try {
            for (var field in fields) {
                if (!fields.hasOwnProperty(field)) continue;
                k++;
                if (k > 2)
                    break;
                data[fields[field].name] = fields[field].value;
            }
            var textareas = $('#addNewsForm textarea');
            data[textareas[0].name] = textareas[0].value;
            data[textareas[1].name] = textareas[1].value;
            data.id = news_id;
            var obj = {};
                obj.url = "http://" + window.location.host + "/adminium/edit_news";
                obj.data = data;
            Ajax.post(obj, Admin.editNewsRequestHandler);
        } catch (err) {
            alert(err.toString);
        }
    },
    editNewsRequestHandler: function(res) {
        if (res.result) {
            window.refresh('/adminium/news');
        }
    },
    saveCategory: function(user_id) {
        var data = {};
            data.id = user_id;
            data.category = document.getElementsByName('category')[0].value;
        var obj = {};
            obj.url = "http://" + window.location.host + "/adminium/save_user_category";
            obj.data = data;
        Ajax.post(obj, Admin.saveCategoryRequestHandler);
    },
    saveCategoryRequestHandler: function(res) {
        if (res.result) {
            $('#success-save').css({display: 'inline'});
            setTimeout(function() {
                $('#success-save').css({display: 'none'});
            }, 2000);
        }
    },
    signInByUser: function(user_id) {
        var result = confirm("Вы действительно хотите выйти из панели управления и войти как данный пользователь?");
        if (!result) {
            return;
        }
        var data = {};
            data.id = user_id;
        var obj = {};
            obj.url = "http://" + window.location.host + "/adminium/signin_by_user";
            obj.data = data;
        Ajax.post(obj, Admin.signInByUserRequestHandler);
    },
    signInByUserRequestHandler: function(res) {
        if (res.result) {
            window.refresh();
        }
    },
    toggleBan: function(user_id) {
        var data = {};
            data.id = user_id;
        var obj = {};
            obj.url = "http://" + window.location.host + "/adminium/toggle_ban";
            obj.data = data;
        Ajax.post(obj, Admin.toggleBanRequestHandler);
    },
    toggleBanRequestHandler: function(res) {
        if (res.result) {
            window.refresh();
        }
    },
    userConfirm: function(user_id) {
        var data = {};
            data.id = user_id;
        var obj = {};
            obj.url = "http://" + window.location.host + "/adminium/admin_confirm";
            obj.data = data;
        Ajax.post(obj, Admin.userConfirmRequestHandler);
    },
    userConfirmRequestHandler: function(res) {
        if (res.result) {
            window.refresh();
        }
    }
};