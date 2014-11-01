<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */

$sex = $user->getSex();
?>
<div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-6">

        <div class="page-header">
            <h3>Редактирование профиля</h3>
        </div>

        <form class="form-horizontal" id="editForm" onsubmit="User.saveModifiedStart(); return !1;">

            <div class="form-group" id="login_field">
                <label class="col-lg-5 control-label">Логин</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <p class="form-control-static" data-toggle="tooltip" data-placement="right" title="Логин изменить нельзя"><?=$user->getNickName()?></p>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-5 control-label">Имя</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="first_name" value="<?=$user->getFirstName()?>"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-5 control-label">Фамилия</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="last_name" value="<?=$user->getLastName()?>"/>
                    </div>
                </div>
            </div>

            <div class="form-group" style="border-bottom: 1px solid #ccc; padding-bottom: 15px;">
                <label class="col-lg-5 control-label">Пол</label>
                <div class="col-lg-7">
                    <div class="radio">
                        <label>
                            <input type="radio" name="sex" id="sexb" value="b" <?=($sex == 'b' ? 'checked' : '')?>>
                            Мужской
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="sex" id="sexg" value="g" <?=($sex == 'g' ? 'checked' : '')?>>
                            Женский
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-5 control-label">Профиль ВКонтакте</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="vk_profile" value="<?=$user->getVkProfileReference()?>"/>
                    </div>
                    <small>Например, </small><small class="text-primary">http://vk.com/test</small>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-5 control-label">Логин на <a target="_blank" href="http://github.com">GitHub</a></label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <input type="text" class="form-control" name="github_account" value="<?=$user->getGitHubAccountName()?>"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-5 control-label">Телефон</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                        <input type="text" class="form-control" name="phone" value="<?=$user->getPhoneNumber()?>"/>
                    </div>
                    <small>Например, </small><small class="text-primary">+79123456789</small>
                </div>
            </div>

            <div class="form-group" style="border-bottom: 1px solid #ccc; padding-bottom: 15px;">
                <label class="col-lg-5 control-label">Skype</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span></span>
                        <input type="text" class="form-control" name="skype" value="<?=$user->getSkypeAccountName()?>"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-5 control-label">Кафедра</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="faculty" value="<?=$user->getFaculty()?>"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-5 control-label">Группа</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <input type="text" class="form-control" name="university_group" value="<?=$user->getUniversityGroup()?>"/>
                    </div>
                </div>
            </div>

            <div class="form-group" style="border-bottom: 1px solid #ccc; padding-bottom: 15px;">
                <label class="col-lg-5 control-label">Год поступления</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <select class="form-control" name="enrollment_year">
                            <?php for ($cur = intval(date('Y')) - 6; $cur <= intval(date('Y')); ++$cur): ?>
                                <option <?=($cur == $user->getUniversityEnrollmentYear() ? 'selected' : '')?>><?=$cur?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-5 control-label">О себе</label>
                <div class="col-lg-7">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                        <textarea class="form-control" rows="4" name="about"><?=$user->getAbout()?></textarea>
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