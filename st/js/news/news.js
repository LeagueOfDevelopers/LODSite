$(document).ready(function() {
    $('#commentForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            comment: {
                validators: {
                    notEmpty: {
                        message: 'Вы не написали комментарий'
                    }
                }
            }
        }
    });
    Comments._init();
});

var Comments = {
    comment_field: null,
    comment_field_id: 'comment-field',
    replied_selected: null,
    _init: function() {
        if (!this.comment_field) {
            this.comment_field = gebi(this.comment_field_id);
        }
    },
    reply: function(view_name, user_id) {
        this.replied_selected = {
            view_name: view_name,
            user_id: user_id
        };
        location.hash = "#add_comment";
        this.comment_field.focus();
        var reply_layer = $('.comment-reply-selected');
        reply_layer.css({display: 'inline-block'});
        var reply_layer_name = $('#comment-reply-selected-name')[0];
        reply_layer_name.href = '/profile?id=' + user_id;
        reply_layer_name.innerHTML = view_name;
    },
    cancelReply: function() {
        this.replied_selected = null;
        this.comment_field.focus();
        var reply_layer = $('.comment-reply-selected');
        reply_layer.css({display: 'none'});
    },
    sendComment: function() {
        if (!this.comment_field.value.trim().length) {
            return;
        }
        var data = {
            text: this.comment_field.value,
            news_id: All.news_id,
            parent_user_id: this.replied_selected ? this.replied_selected.user_id : 0
        };
        this.comment_field.value = '';

        Ajax.post({
            url: 'http://' + location.host + '/news/add_comment',
            data: data
        }, Comments.requestReplyHandler);
        $('#submit-comment').text('Загрузка...').disabled();
    },
    requestReplyHandler: function(res) {
        if (res.result) {
            window.location.href = window.location.href.replace(/(\#\w*)$/gi, '') + '&comment=' + res.inserted_id;
        }
        $('#submit-comment').text('Добавить').enabled();
    },
    deleteComment: function(comment_id) {
        var data = {
            id: comment_id
        };

        Ajax.post({
            url: 'http://' + location.host + '/news/delete_comment',
            data: data
        }, Comments.requestDeleteHandler);
    },
    requestDeleteHandler: function(res) {
        if (res.result) {
            $('#comment_' + res.comment_id).slideUp(100);
        }
    },
    attachImageLink: function() {
        var link = prompt("Вставьте ссылку на изображение");
        link && (this.comment_field.value += (this.comment_field.value.length ? ' ' : '') + '['+link+'] ');
        var end = this.comment_field.value.length;
        this.comment_field.setSelectionRange(end, end);
    },
    attachLink: function() {
        var link = prompt("Вставьте ссылку");
        link && (this.comment_field.value += (this.comment_field.value.length ? ' ' : '') +link+' ');
        var end = this.comment_field.value.length;
        this.comment_field.setSelectionRange(end, end);
    }
};