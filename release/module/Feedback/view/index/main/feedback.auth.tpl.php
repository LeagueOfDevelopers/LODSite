<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */
/** @var \Lod\User\User $cur_user */
?>
<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>Написать письмо Администраторам</h1>
        </div>

        <div class="alert alert-success" id="success-feedback-send" style="display: none;">
            <strong>Сообщение успешно отправлено.</strong>
        </div>

        <form class="form-horizontal" id="feedbackForm" onsubmit="return !1;">

            <div class="form-group" id="login_field">
                <div class="col-lg-8">
                    <div class="input-group">
                        <p class="form-control-static">От: <?=$user->getEmail()?></p>
                        <input style="display: none;" type="text" class="form-control" name="email" value="<?=$user->getEmail()?>"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-comment"></span></span>
                        <textarea id="text_add_news" class="form-control" placeholder="Текст письма" rows="9" name="text"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-8">
                    <button type="submit" class="btn btn-primary" onclick="Feedback.send()">Отправить</button>
                </div>
            </div>
        </form>

    </div>
</div>