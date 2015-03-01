<?php

$project_list = $this->getData()['projects_list'];
$usersOnProject_list = $this->getData()['userOnProject'];
$freeUsers = $this->getData()['freeUsers'];
?>
<div class="container-fluid">
    <div class="row">
        <?php
        $this->includeModuleView('common.menu');
        ?>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Трекер</h1>
			  <a href="/adminium/createProjectByHand" class="btn btn-primary" role="button" style = "margin-right:10px;"> Создать проект</a>
			  <a href="#" class="btn btn-primary" role="button" style = "margin-right:10px;"> Выполненые проекты</a>		      
   				<div class="modal fade" id="ShowFreeUsers" tabindex="-1" role="dialog">
				     <div class="modal-dialog">
				       <div class="modal-content">
				          <div class="modal-header"><button class="close" type="button"  data-dismiss="modal">x</button>
				             <h4 class="modal-title" id="myModalLabel">Разработчики</h4>
				          </div>
				        <div class="modal-body">
				          <h3>Свободные разработчки</h3>
				          <?php if(!empty($freeUsers)):?>
				          <table class="table" style = "margin-top:20px;">
								<thead>
									<tr>
									<th style="text-align:center;">Имя</th>
									<th style="text-align:center;">Ссылка на профиль</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($freeUsers as $users):?>
									<tr>
									<td style="text-align:center;"><?=$users->getViewName();?></td>
									<td style="text-align:center;"><a href="/profile?id=<?=$users->getId()?>" class="btn btn-primary" role="button" style = "margin-right:10px;">Показать</></td>
									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
							<?php else:?>
							Нет свободных разработчиков
							<?php endif;?>
					    </div>
					       <div class="modal-footer"><button class="btn btn-default" type="button"  data-dismiss="modal">Закрыть</button></div>
					    </div>
					  </div>
					</div>
				<a class="btn btn-primary" href="#ShowFreeUsers" data-toggle="modal">Показать свободных разработчиков</a>
	   <table class="table" style = "margin-top:20px;">
			<thead>
			<tr>
			<th>Название</th>
			<th>Тип</th>
			<th>Описание</th>
			<th>Заказчик</th>
			<th>Срок</th>
			<th>Состояние</th>
			<th>Ссылка git</th>
			<th style="text-align:center;">На проекте</th>
			<th style="text-align:center;">Полная информация</th>
			</tr>
			</thead>
			<tbody>
			<?php $m = 1;?>
			<?php $i = 0;?>
			<?php foreach($project_list as $project):?>
			<tr>
			<td><?=$project->getName();?></td>
			<td><?=$project->getTypeText();?></td>
			<td>
				<div class="bs-docs-example">
				<div class="accordion" id="accordion<?=$m?>">
				<div class="accordion-group">
				<div class="accordion-heading"><a class="accordion-toggle collapsed btn btn-small btn-success" href="#collapse<?=$m?>" data-toggle="collapse" data-parent="#accordion<?=$m?>">
				Описание
				</a></div>
				<div class="accordion-body collapse" id="collapse<?=$m?>" style="height: 0px;">
				<div class="accordion-inner"><?=$project->getDescription();?>
				</div>
				</div>
				</div>
				</div>
				</div>
			</td>
			<td><?=$project->getNameOfOrder();?></td>
			<td><?=$project->getDeadLine();?></td>
			<td><?=$project->getTypeStatus();?></td>
			<td><?=$project->getGitHub();?></td>
			<td style="text-align:center;">
				<div class="modal fade" id="basicModal<?=$m;?>" tabindex="-1" role="dialog">
				     <div class="modal-dialog">
				       <div class="modal-content">
				          <div class="modal-header"><button class="close" type="button"  data-dismiss="modal">x</button>
				             <h4 class="modal-title" id="myModalLabel"> Разработчики</h4>
				          </div>
				        <div class="modal-body">
				          <h3>Разработчики на проекте</h3>
						<?php if(!empty($usersOnProject_list[$i])):?>
				        <table class="table" style = "margin-top:20px;">
							<thead>
								<tr>
									<th style="text-align:center;">Имя</th>
									<th style="text-align:center;">Роль</th>
								</tr>
							</thead>
								<tbody>
									
									<?php foreach($usersOnProject_list[$i] as $UsersOn ):?>
										<?php if(empty($usersOnProject_list[$i])){ echo("Пустой");break;}?> 
											<tr>
												<td style="text-align:center;"><?=$UsersOn->getViewName()?></td>
												<td style="text-align:center;"><?=$UsersOn->getStatusOnProject($project->getId(), $UsersOn->getId());?></td>
											</tr>

									<?php endforeach;?>
								</tbody>
							</table>
							<?php else:?>
							Никто не назначен
							<?php endif;?>	
					        </div>
					       <div class="modal-footer"><button class="btn btn-default" type="button"  data-dismiss="modal">Закрыть</button></div>
					    </div>
					  </div>
					</div>
				<a class="btn btn-small btn-success" href="#basicModal<?=$m;?>" data-toggle="modal">Показать</a>		
	<?php $m++;?>
	<?php $i++;?>
			</td>
			<td style="text-align:center;"><a class="btn btn-success" href="/adminium/showCartProject?id=<?=$project->getId();?>">Показать</a></td>
			</tr>
			<?php endforeach;?>
			</tbody>
		</table>
			
	</div>

</div>