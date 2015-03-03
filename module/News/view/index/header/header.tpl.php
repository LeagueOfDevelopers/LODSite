<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
/** @var \Lod\News\NewsItem $news_item */
$news_item = $this->getData()['news_item'];
?>
<div class="page-header breadcrumb" style="padding: 2px 26px 10px;">
    <h1 style="font-size: 30px; line-height: 1.3;"><?=$news_item->getTitle()?></h1>
</div>