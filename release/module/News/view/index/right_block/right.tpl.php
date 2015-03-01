<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
/** @var \Lod\News\NewsItem $news_item */
$news_item = $this->getData()['news_item'];
$news_user = $news_item->getUserObject();
?>
<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">

    <div class="page-header">
        <h1><small>Информация о новости</small></h1>
    </div>

    <ul class="list-group">
        <li class="list-group-item"><b>Автор</b>: <a href="/profile?id=<?=$news_user->getId()?>"><?=$news_user->getViewName()?></a></li>
        <li class="list-group-item"><b>Добавлена</b>: <span class="badge badge-lod-blue"><?=$news_item->getDate()?></span></li>
        <li class="list-group-item"><b>Просмотров</b>: <span class="badge badge-lod-blue"><?=$news_item->getCountViews()?></span></li>
        <li class="list-group-item"><b>Комментариев</b>: <span class="badge badge-lod-blue"><?=$news_item->getCountComments()?></span></li>
    </ul>

</div>