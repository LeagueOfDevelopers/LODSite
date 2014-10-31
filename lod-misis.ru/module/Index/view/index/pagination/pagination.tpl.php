<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$pagination = $this->getData()['pagination'];
?>
<ul class="pagination">
    <?php if (!$pagination['left']['disabled']): ?>
        <li><a href="/?page=<?=$pagination['left']['value']?>"><?=$pagination['left']['view_symbol']?></a></li>
    <?php endif; ?>

    <?php foreach ($pagination['pagination'] as $entity): ?>
        <?php if ($entity['active']): ?>
            <li class="active"><span><?=$entity['view_number']?> <span data-toggle="tooltip" data-placement="top" title="Страница" class="sr-only">(current)</span></span></li>
        <?php endif; ?>
        <?php if (!$entity['active']): ?>
            <li><a href="/?page=<?=$entity['page']?>"><?=$entity['view_number']?></a></li>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if (!$pagination['right']['disabled']): ?>
        <li><a href="/?page=<?=$pagination['right']['value']?>"><?=$pagination['right']['view_symbol']?></a></li>
    <?php endif; ?>
</ul>