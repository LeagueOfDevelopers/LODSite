<div class="container">
<?php $project = $this->getData()['project'];?>
    <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
            <ol class="breadcrumb" style = "width:800px;">
                <li><a href="/">Главная</a></li>
                <li class="active">Портфолио</li>
            </ol>
            <div class="container-fluid" style = "padding:0px;">
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style = "margin:0px;padding:0px; width:800px;">
    <h1 class="page-header" style = "margin:0px;">Карточка проекта <a style="cursor: default; color: #FFF; margin-right: 10px; margin-bottom: 10px; background-color: #8CB83D; text-decoration: none !important; border-radius: 3px; font-size: 14px; padding: 13px; float: right;" ><?=$project->getTypeStatus()?></a></h1>

    <div class="panel panel-default">
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
            <td><b>Ссылка git</b></td>
            <td><a href="<?=$project->getGitHub();?>"><?=$project->getGitHub();?></a></td>
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
    </div>

</div>
        </div>
    </div>
    <div id="photo-overlay" style="opacity: 0; position: fixed; height: 100%; width: 100%; background: rgba(0, 0, 0, 0.77); z-index: 1000; top: 0; left: 0; display: none;"></div>
    <div class="photo-container-wrapper" style="display: none;">
        <div class="photo-container" style="overflow-y: auto; max-height: 750px; max-width: 70%; top: -20px;"></div>
    </div>

    <?php
    $this->includeView('footer');
    ?>
</div>