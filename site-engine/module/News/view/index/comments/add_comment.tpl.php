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
                        <div class="dropdown">
                            <a id="dLabel" role="button" data-toggle="dropdown" href="#">Прикрепить <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li>
                                    <a href="#" onclick="Comments.attachImageLink(); return !1;" style="color: #555;">
                                        <span style="cursor: pointer;" class="glyphicon glyphicon-picture"></span>
                                        Изображение
                                    </a>
                                </li>
                                <li>
                                    <a href="#" onclick="Comments.attachLink(); return !1;" style="color: #555;">
                                        <span style="cursor: pointer;" class="glyphicon glyphicon-link"></span>
                                        Ссылку
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <button id="submit-comment" type="submit" onclick="Comments.sendComment();" class="btn btn-primary">Добавить</button>
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