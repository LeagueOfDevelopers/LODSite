<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-6">

        <div class="page-header">
            <h3>Сброс пароля</h3>
        </div>

        <div class="alert alert-success" id="success-password-reset" style="display: none;">
            <strong>На Ваш e-mail выслана инструкция для смены пароля.</strong>
        </div>

        <div class="alert alert-danger" id="danger-password-reset" style="display: none;">
            <strong>E-mail не найден.</strong>
        </div>

        <form class="form-horizontal" id="resetPasswordForm" onsubmit="User.resetPassword(); return !1;">

            <div class="form-group">
                <label class="col-lg-5 control-label">Ваш e-mail</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="email" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-5 control-label"></label>
                <div class="col-lg-7">
                    <button type="submit" class="btn btn-primary">Сбросить</button>
                </div>
            </div>
        </form>

    </div>
</div>