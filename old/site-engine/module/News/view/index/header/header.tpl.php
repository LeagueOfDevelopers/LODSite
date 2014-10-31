<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
/** @var \Lod\News\NewsItem $news_item */
$news_item = $this->getData()['news_item'];
?>
<div class="page-header">
    <h1><?=$news_item->getTitle()?></h1>
</div>