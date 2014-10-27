<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$key = $this->getData()['key'];
?>
<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-6">

        <div class="page-header">
            <h3>Введите новый пароль</h3>
        </div>

        <div class="alert alert-success" id="success-password-new" style="display: none;">
            <strong>Пароль успешно изменен.</strong>
        </div>

        <div class="alert alert-danger" id="danger-password-new" style="display: none;">
            <strong>Произошла ошибка.</strong>
        </div>

        <script type="text/javascript">var NewPassword = { key: '<?=$key?>' };</script>
        <form class="form-horizontal" id="newPasswordForm" onsubmit="User.newPassword(); return !1;">

            <div class="form-group">
                <label class="col-lg-5 control-label">Новый пароль</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" class="form-control" name="new_password" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-5 control-label">Новый пароль еще раз</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" class="form-control" name="new_password_confirm" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-5 control-label"></label>
                <div class="col-lg-7">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </form>

    </div>
</div>