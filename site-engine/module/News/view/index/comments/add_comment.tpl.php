<div class="panel panel-default">
    <a name="add_comment"></a>
    <div class="panel-heading">Добавить комментарий</div>
    <div class="panel-body">
        <form class="form-horizontal" id="commentForm" onsubmit="return !1;">
            <div class="form-group">
                <label class="col-lg-3 control-label">Текст комментария</label>
                <div class="col-md-8">
                    <textarea id="comment-field" class="form-control" name="comment" rows="8"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"></label>
                <div class="col-lg-8">
                    <div class="comment-attachments">
                        <div style="color: #747474; font-size: 16px;">
                            <span style="cursor: pointer;" onclick="Comments.attachImageLink()" class="glyphicon glyphicon-picture"></span>
                            <span onclick="Comments.attachLink()" style="cursor: pointer; margin-left: 6px;" class="glyphicon glyphicon-link"></span>
                        </div>
                    </div>
                    <button type="submit" onclick="Comments.sendComment();" class="btn btn-primary">Добавить</button>
                    <div class="comment-reply-selected" style="display: none;">
                        <span onclick="Comments.cancelReply()" class="glyphicon glyphicon-remove comment-reply-remove-selected" data-toggle="tooltip" data-placement="right" title="Удалить"></span>
                        <span>ответ пользователю </span>
                        <a id="comment-reply-selected-name" target="_blank" href="/profile"></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>