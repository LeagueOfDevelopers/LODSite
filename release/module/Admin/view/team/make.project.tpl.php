<?php 
$order = $this->getData()['order'];
$usersfree = $this->getData()['users'];
?>
<div class="container-fluid">
    <div class="row">
        <?php
        $this->includeModuleView('common.menu');
        ?>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" >
		<div class="page-header">
            <h1>Информация о проекте</h1>
        </div>

        <form class="form-horizontal" method="POST"  action="/adminium/createProject?id=<?=$order->getId();?>&type=order" >

            <div class="form-group" id="login_field">
                <label class="col-lg-2 control-label">Название проекта</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <input type="text" class="form-control" name="name" value="" />
                    </div>
                </div>
            </div>

            <div class="form-group" id="login_field">
                <label class="col-lg-2 control-label">Имя заказчика</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <input type="text" class="form-control" name="name_of_order" value="<?=$order->getFio()?>" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Описание</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <textarea class="form-control" rows="4" name=" description"><?=$order->getDescription();?></textarea>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-2 control-label">Тип заказа</label>
                <div class="col-lg-8">
                    <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                    <select class="form-control" name="type" value ="<?=$order->getType();?>">
                                                    <option value="1">Верстка/макет сайта</option>
                                                    <option value="2">Сайт</option>
                                                    <option value="3">Мобильное приложение Android/iOS/WP</option>
                                                    <option value="4">Desktop-приложение</option>
                                                    <option value="5">Другое</option>
                    </select>
                    </div>
                </div>
            </div>
            <div class="form-group" id="login_field">
                <label class="col-lg-2 control-label">GitHub</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <input type="text" class="form-control" name="git_hub" value="<?=$order->getType();?>" />
                    </div>
                </div>
            </div>
            <div class="form-group" id="login_field">
                <label class="col-lg-2 control-label">Статус</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <select class="form-control" name="status" value ="">
                                                    <option value="1">Заморожен</option>
                                                    <option value="2">В процессе</option>
                                                    <option value="3">Выполнен</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group" id="login_field">
                <label class="col-lg-2 control-label">Дедлайн</label>
                <div class="col-lg-8">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-tag"></span></span>
                        <input type="text" class="form-control" name="deadline" value="<?=$order->getFinishDate();?>" />
                    </div>
                </div>
            </div> 
            <div class="page-header">
            <h1>Выбор пользователей</h1>
            </div>
            <table class="table" style = "margin-top:20px;">
            <thead>
            <tr>
            <th style="text-align:center;">Имя</th>
            <th style="text-align:center;">Статус на проекте</th>
            <th style="text-align:center;">Выбрать</th>
            </tr>
            </thead>
            <tbody>
            <?php $k = 0;?>
            <?php foreach($usersfree as $user):?><tr>
            <td style="text-align:center;"><?=$user->getViewName();?></td>
            <th style="text-align:center;">
                <label class="radio">
                <input type="text" name="statusonproject<?=$user->getId();?>" id="optionsRadios1" value="" checked>
            </th>
            <td style="text-align:center;"><label class="checkbox inline"><input type="checkbox" id="inlineCheckbox1"  name = "checkboxuser[]" value="<?=$user->getId();?>"> </label></td>
            </tr>
           <?php endforeach;?>
            </tbody>
        </table>
            <div class="form-group">
                <label class="col-lg-4 control-label"></label>
                <div class="col-lg-5">
                    <button type="submit" class="btn btn-primary" onclick="">Сохранить изменения</button>
                </div> 
            </div>
        </form>
	</div>
</div>