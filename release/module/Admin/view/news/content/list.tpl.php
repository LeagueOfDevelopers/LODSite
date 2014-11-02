<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
$news = $this->getData()['news']['news_list'];
?>
<div class="row">
    <?php /** @var \Lod\News\NewsItem $news_item */
    foreach($news as $news_item): ?>
        <div class="col-sm-12 col-md-12">
            <div class="thumbnail">
                <div class="caption">
                    <h3><?=$news_item->getTitle()?></h3>
                    <div class="news-date">
                        <span>Добавлено <?=$news_item->getDate()?></span>
                    </div>
                    <p><?=$news_item->getPreviewText()?></p>
                    <p>
                        <a target="_blank" href="/news?id=<?=$news_item->getId()?>#comments" class="btn btn-default" role="button">Комментарии <span class="badge"><?=$news_item->getCountComments()?></span></a>
                        <a target="_blank" href="/news?id=<?=$news_item->getId()?>" class="btn btn-primary" role="button" style="margin-left: 10px;">Перейти к новости »</a>
                        <a href="/adminium/news?act=edit&id=<?=$news_item->getId()?>" class="btn btn-success" role="button" style="margin-left: 10px;">
                            <span class="glyphicon glyphicon-edit"></span>
                            Редактировать новость
                        </a>
                        <a onclick="Admin.deleteNews(<?=$news_item->getId()?>)" class="btn btn-danger" role="button" style="margin-left: 10px;">
                            <span class="glyphicon glyphicon-remove"></span>
                            Удалить новость
                        </a>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>