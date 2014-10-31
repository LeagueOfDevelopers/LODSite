<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
/** @var \Lod\News\NewsItem $news_item */
$news_item = $this->getData()['news_item'];
?>
<ol class="breadcrumb">
    <li><a href="/">Главная</a></li>
    <li><a href="/news">Новости сайта</a></li>
    <li class="active"><?=$news_item->getTitle()?></li>
</ol>