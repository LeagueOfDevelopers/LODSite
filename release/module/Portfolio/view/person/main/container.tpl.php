<?php

$project_list = $this->getData()['projects_list'];
$user_portfolio = $this->getData()['user_portfolio'];  
?>
<div class="container-fluid" >
    <div class="row">
        <?php
        $this->includeModuleView('common.menu');
        ?>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style = "margin:0px; padding:0px; width:830px;">
       <h1 class="page-header" style = "margin-top:0px;">Портфолио разработчика</h1>
       <table class="table">
            <thead>
            <tr>
            <th style="text-align:center;">Название</th>
            <th style="text-align:center;">Тип</th>
            <th style="text-align:center;">Роль</th>
            <th style="text-align:center;">Состояние</th>
            <th style="text-align:center;">Действие</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($project_list as $project):?>
            <?php $a = $project->getTypeStatus()?>
            <?php if($a != "Заморожен"):?>
            <tr>
            <td style="text-align:center;"><?=$project->getName();?></td>
            <td style="text-align:center;"><?=$project->getTypeText();?></td>
            <td style="text-align:center;"><?=$user_portfolio->getStatusOnProject($project->getId(), $user_portfolio->getId())?></td>
            <td style="text-align:center;"><?=$project->getTypeStatus();?></td>
            <td style="text-align:center;"><a class="btn btn-small btn-success" href="/portfolio/showCartProject?id=<?=$project->getId();?>" data-toggle="modal">Показать</a></td>
            </tr>
            <?php endif;?>
            <?php endforeach;?>
            </tbody>
        </table>
            
    </div>

</div>