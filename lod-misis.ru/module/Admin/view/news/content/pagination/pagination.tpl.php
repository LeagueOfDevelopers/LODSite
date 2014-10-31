<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$pagination = $this->getData()['news']['pagination'];
?>
<ul class="pagination">
    <?php if ($pagination['left']['disabled']): ?>
        <li class="disabled"><span><?=$pagination['left']['view_symbol']?></span></li>
    <?php else: ?>
        <li><a href="/adminium/news?page=<?=$pagination['left']['value']?>"><?=$pagination['left']['view_symbol']?></a></li>
    <?php endif; ?>

    <?php foreach ($pagination['pagination'] as $entity): ?>
        <?php if ($entity['active']): ?>
            <li class="active"><span><?=$entity['view_number']?> <span class="sr-only">(current)</span></span></li>
        <?php endif; ?>
        <?php if (!$entity['active']): ?>
            <li><a href="/adminium/news?page=<?=$entity['page']?>"><?=$entity['view_number']?></a></li>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if ($pagination['right']['disabled']): ?>
        <li class="disabled"><span><?=$pagination['right']['view_symbol']?></span></li>
    <?php else: ?>
        <li><a href="/adminium/news?page=<?=$pagination['right']['value']?>"><?=$pagination['right']['view_symbol']?></a></li>
    <?php endif; ?>
</ul>