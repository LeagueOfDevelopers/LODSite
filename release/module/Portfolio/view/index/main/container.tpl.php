<div class="panel panel-default" style = "width:800px;">
    <div class="panel-heading" style = "width:800px;">Портфолио всех разработчиков</div>
    <?php
    	$users = $this->getData()['users']['users_list'];
        $user = $this->getData()['user'];
        $pagination = $this->getData()['users']['pagination'];
?>

    <table class="table" style = "width:800px;">
        <tbody>
            <?php foreach ($users as $user):?>
            <tr>
                <td style = "text-align:center;"><a href ="/profile?id=<?=$user->getId();?>"><div class="profile-img-wrapper " id="profile-image" style="background-image: url(<?=$user->getPhotoLink()?>);"></div></a></td>
                <td style = "text-align:left;"><a href ="/profile?id=<?=$user->getId();?>" style = "text-decoration:none; color:black;"><h3 style = "margin-left:40px;"><?=$user->getFormatFullName();?></h3></a></td>
                <td style = "text-align:center;"><h3><a href="/portfolio/person?id=<?=$user->getId()?>" class="btn btn-large btn-info " role="button"> Просмотреть</a></h3><td>
            </tr>
       <?php endforeach;?>
       <?php ?>
        </tbody>
    </table>
    <div style="text-align: center;">
        <ul class="pagination">
            <?php if ($pagination['left']['disabled']): ?>
                <li class="disabled"><span><?=$pagination['left']['view_symbol']?></span></li>
            <?php else: ?>
                <li><a href="/portfolio/index?page=<?=$pagination['left']['value']?>"><?=$pagination['left']['view_symbol']?></a></li>
            <?php endif; ?>

            <?php foreach ($pagination['pagination'] as $entity): ?>
                <?php if ($entity['active']): ?>
                    <li class="active"><span><?=$entity['view_number']?> <span class="sr-only">(current)</span></span></li>
                <?php endif; ?>
                <?php if (!$entity['active']): ?>
                    <li><a href="/portfolio/index?page=<?=$entity['page']?>"><?=$entity['view_number']?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if ($pagination['right']['disabled']): ?>
                <li class="disabled"><span><?=$pagination['right']['view_symbol']?></span></li>
            <?php else: ?>
                <li><a href="/portfolio/index?page=<?=$pagination['right']['value']?>"><?=$pagination['right']['view_symbol']?></a></li>
            <?php endif; ?>
        </ul>
    </div>
</div> 