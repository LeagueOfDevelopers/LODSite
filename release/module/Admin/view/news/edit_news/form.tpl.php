<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */
/** @var \Lod\News\NewsItem $news_item */
$news_item = $this->getData()['news_item'];
?>
<div class="row margin20">
    <div class="col-xs-8">

        <div class="page-header">
            <h1>Редактирование новости</h1>
        </div>

        <form class="form-horizontal" id="addNewsForm" onsubmit="return !1;">

            <div class="form-group" id="login_field">
                <label class="col-lg-4 control-label">Заголовок</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <input type="text" class="form-control" name="title" value="<?=$news_item->getTitle()?>" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">Превью текст</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <textarea class="form-control" rows="4" name="preview_text"><?=$news_item->getPreviewText()?></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group" id="login_field">
                <label class="col-lg-4 control-label">Ссылка на фотографию (по желанию)</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-link"></span></span>
                        <input type="text" class="form-control" name="photo" value="<?=$news_item->getPhoto()?>" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">Текст полной новости</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <textarea id="text_add_news" class="form-control" rows="9" name="text"><?=$news_item->getText()?></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label"></label>
                <div class="col-lg-5">
                    <div class="comment-attachments">
                        <div class="dropdown">
                            <a id="dLabel" role="button" data-toggle="dropdown" href="#">Прикрепить <b class="caret"></b></a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                <li>
                                    <a href="#" onclick="Admin.attachImageLink(); return !1;" style="color: #555;">
                                        <span style="cursor: pointer;" class="glyphicon glyphicon-picture"></span>
                                        Изображение
                                    </a>
                                </li>
                                <li>
                                    <a href="#" onclick="Admin.attachLink(); return !1;" style="color: #555;">
                                        <span style="cursor: pointer;" class="glyphicon glyphicon-link"></span>
                                        Ссылку
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="Admin.editNews(<?=$news_item->getId()?>)">Сохранить изменения</button>
                </div>
            </div>
        </form>

    </div>
</div>