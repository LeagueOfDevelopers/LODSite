<?php 
$project = $this->getData()['project'];
$userOnProject = $this->getData()['useronproject'];
?>
<div class="container-fluid">
    <div class="row">
        <?php
        $this->includeModuleView('common.menu');
        ?>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Карточка проекта <a style="cursor: default; color:white; background: #e67e22; margin-right: 10px; margin-bottom: 10px; background-color:grey;" ><?=$project->getTypeStatus()?></a></h1>

	<div class="panel panel-default" style = "margin-top:20px;">
    <div class="panel-heading">Основная информация </div>
	<table class="table" >
        <tbody>
        <tr>
            <td><b>Название</b></td>
            <td><?=$project->getName();?></td>
        </tr>
        <tr>
            <td><b>Тип</b></td>
            <td><?=$project->getTypeText();?></td>
        </tr>
        <tr>
            <td><b>Заказчик</b></td>
            <td><?=$project->getNameOfOrder();?></td>
        </tr>
        <tr>
            <td><b>Срок</b></td>
            <td><?=$project->getDeadLine();?></td>
        </tr>
        <tr>
            <td><b>Ссылка git</b></td>
            <td><?=$project->getGitHub();?></td>
        </tr>
        </tbody>
    </table>
	</div>
	<div class="panel panel-default">
    <div class="panel-heading">Описание</div>
    <div class="panel-body">
        <?=$project->getDescriptionF();?>
    </div>
	</div>
	<div class="panel panel-default">
    <div class="panel-heading">Разработчики на проекте</div>
    <div class="panel-body">
	<table class="table" style = "margin-top:20px;">
								<thead>
									<tr>
									<th style="text-align:center;">Имя</th>
                                    <th style="text-align:center;">Статус на проекте</th>
									<th style="text-align:center;">Действие</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($userOnProject as $users):?>
									<tr>
									<td style="text-align:center;"><?=$users->getViewName();?></td>
                                    <th style="text-align:center;"><?=$users->getStatusOnProject($project->getId(), $users->getId() );?></th>
									<td style="text-align:center;"><a href="/adminium/deleteUserFromProject?id_u=<?=$users->getId();?>&id_p=<?=$project->getId();?>" class="btn btn-primary" role="button" style = "margin-right:10px;">Удалить</a></td>
									</tr>
									<?php endforeach;?>
								</tbody>
	</table>			
	</div>
	</div>
	<a href="/adminium/editProject?id=<?=$project->getId();?>" class="btn btn-info" role="button" style = "margin-right:10px;"> Редактировать</a>	
	</div>

</div>