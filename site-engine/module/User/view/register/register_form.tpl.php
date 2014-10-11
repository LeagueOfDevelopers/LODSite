<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-6">

        <div class="page-header">
            <h1>Регистрация <small></small></h1>
        </div>

        <form class="form-horizontal" id="registerForm" method="post" action="">

            <div class="form-group">
                <label class="col-lg-3 control-label">Логин</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <input type="text" class="form-control" name="login" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Имя</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="first_name" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Фамилия</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="last_name" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">E-mail</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="text" class="form-control" name="email" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Пароль</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" class="form-control" name="password" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">Пароль еще раз</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input id="confirm_password" type="password" class="form-control" name="passwordagain" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"></label>
                <div class="col-lg-5">
                    <a href="#">Правила пользования сайтом</a>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"></label>
                <div class="col-lg-5">
                    <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                </div>
            </div>
        </form>

    </div>
</div>