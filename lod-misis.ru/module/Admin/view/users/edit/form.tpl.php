<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
/**
 * @var $user \Lod\User\User
 */
/** @var \Lod\User\User $cur_user */
$cur_user = $this->getData()['cur_user'];
?>
<div class="row">
    <div class="col-xs-12">

        <div class="panel panel-default">
            <div class="panel-heading">Редактирование категории для <a target="_blank" href="/profile?id=<?=$cur_user->getId()?>"><?=$cur_user->getViewName()?></a></div>

            <div class="row margin20">
                <div class="col-xs-8">

                    <div class="page-header">
                        <h1><?=$cur_user->getViewName()?></h1>
                    </div>

                    <form class="form-horizontal" id="editCategoryForm" onsubmit="return !1;">

                        <div class="form-group">
                            <label class="col-lg-4 control-label">Категория</label>
                            <div class="col-lg-5">
                                <div class="input-group">
                                    <select class="form-control" name="category">
                                        <option <?=$cur_user->getAccessLevel() == 1 ? 'selected' : ''?> value="1">Гость</option>
                                        <option <?=$cur_user->getAccessLevel() == 5 ? 'selected' : ''?> value="5">Разработчик</option>
                                        <option <?=$cur_user->getAccessLevel() == 8 ? 'selected' : ''?> value="8">Менеджер</option>
                                        <option <?=$cur_user->getAccessLevel() == 10 ? 'selected' : ''?> value="10">Администратор</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-4 control-label"></label>
                            <div class="col-lg-5">
                                <button type="submit" class="btn btn-primary" onclick="Admin.saveCategory(<?=$cur_user->getId()?>);">Сохранить изменения</button>
                                <a href="<?=$_SERVER['HTTP_REFERER']?>" class="btn btn-info">Назад</a>
                                <span id="success-save" style="display: none; color: darkgreen; margin-left: 5px;" class="glyphicon glyphicon-ok"></span>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>