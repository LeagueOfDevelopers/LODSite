<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */
?>
<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-6">

        <div class="page-header">
            <h3>Смена пароля</h3>
        </div>

        <div class="alert alert-success" id="success-password-change" style="display: none;">
            <strong>Пароль успешно изменен.</strong>
        </div>

        <div class="alert alert-danger" id="danger-password-change" style="display: none;">
            <strong>Пароль не изменен, так как не совпадает старый пароль.</strong>
        </div>

        <form class="form-horizontal" id="changePasswordForm" onsubmit="User.changePassword(); return !1;">

            <div class="form-group">
                <label class="col-lg-5 control-label">Старый пароль</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" class="form-control" name="old_password" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-5 control-label">Новый пароль</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" class="form-control" name="new_password"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-5 control-label">Новый пароль еще раз</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" class="form-control" name="new_password_confirm"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-5 control-label"></label>
                <div class="col-lg-7">
                    <button type="submit" class="btn btn-primary">
                        <span id="refresh-password" class="glyphicon glyphicon-refresh" style="display: none;"></span>
                        Сменить
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>