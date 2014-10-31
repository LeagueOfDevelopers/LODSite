<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-6">

        <div class="page-header">
            <h1>Заявка на вступление в Лигу Разработчиков <small></small></h1>
        </div>

        <form class="form-horizontal" id="registerForm" onsubmit="User.signUpStart(); return !1;">

            <div class="form-group" id="login_field">
                <label class="col-lg-4 control-label">Логин<span class="text-danger" style="margin-left:3px;">*</span></label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <input type="text" class="form-control" name="login" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">Имя<span class="text-danger" style="margin-left:3px;">*</span></label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="first_name" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">Фамилия<span class="text-danger" style="margin-left:3px;">*</span></label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="last_name" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">E-mail<span class="text-danger" style="margin-left:3px;">*</span></label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="text" class="form-control" name="email" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">Пароль<span class="text-danger" style="margin-left:3px;">*</span></label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" id="register_password" class="form-control" name="password" />
                    </div>
                </div>
            </div>

            <div class="form-group" id="confirm_field">
                <label class="col-lg-4 control-label">Пароль еще раз<span class="text-danger" style="margin-left:3px;">*</span></label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" class="form-control" name="passwordagain" />
                    </div>
                </div>
            </div>

            <div class="form-group" style="border-bottom: 1px solid #ccc; padding-bottom: 15px;">
                <label class="col-lg-4 control-label">Пол<span class="text-danger" style="margin-left:3px;">*</span></label>
                <div class="col-lg-5">
                    <div class="radio">
                        <label>
                            <input type="radio" name="sex" id="sexb" value="b" checked>
                            Мужской
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="sex" id="sexg" value="g">
                            Женский
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">Профиль ВКонтакте<span class="text-danger" style="margin-left:3px;">*</span></label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="vk_profile" />
                    </div>
                    <small>Например, </small><small class="text-primary">http://vk.com/test</small>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">Логин на <a target="_blank" href="http://github.com">GitHub</a><span class="text-danger" style="margin-left:3px;">*</span></label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <input type="text" class="form-control" name="github_account" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">Телефон<span class="text-danger" style="margin-left:3px;">*</span></label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                        <input type="text" class="form-control" name="phone" />
                    </div>
                    <small>Например, </small><small class="text-primary">+79123456789</small>
                </div>
            </div>

            <div class="form-group" style="border-bottom: 1px solid #ccc; padding-bottom: 15px;">
                <label class="col-lg-4 control-label">Skype</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
                        <input type="text" class="form-control" name="skype" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">Кафедра</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="faculty" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">Группа</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="university_group" />
                    </div>
                </div>
            </div>

            <div class="form-group" style="border-bottom: 1px solid #ccc; padding-bottom: 15px;">
                <label class="col-lg-4 control-label">Год поступления</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <select class="form-control" name="enrollment_year">
                            <?php for ($cur = intval(date('Y')) - 6; $cur <= intval(date('Y')); ++$cur): ?>
                            <option <?=($cur == date('Y') ? 'selected' : '')?>><?=$cur?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label">О себе</label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <textarea class="form-control" rows="4" name="about"></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-4 control-label"></label>
                <div class="col-lg-5">
                    <button id="register_button" type="submit" class="btn btn-primary">Зарегистрироваться</button>
                </div>
            </div>
        </form>

    </div>
</div>