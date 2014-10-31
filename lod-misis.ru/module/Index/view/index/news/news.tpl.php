<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$user = $this->getData()['user'];
$news = $this->getData()['news'];
?>
<div class="row">
    <?php /** @var \Lod\News\NewsItem $news_item */
    foreach($news as $news_item): ?>
        <?php $news_user = $news_item->getUserObject(); ?>
        <div class="col-sm-12 col-md-12">
            <div class="thumbnail">
                <div class="caption" style="overflow: hidden;">
                    <h3><a href="/news?id=<?=$news_item->getId()?>"><?=$news_item->getTitle()?></a></h3>
                    <div class="news-date">
                        <span>Добавлено <?=$news_item->getDate()?> | </span>
                        <span>
                            Автор:
                            <a target="_blank" href="/profile?id=<?=$news_user->getId()?>"><?=$news_user->getViewName()?></a>
                            <?php if ($news_user->isOnline()):?>
                                <span data-toggle="tooltip" data-placement="right" title="Online" class="online-pointer"></span>
                            <?php endif; ?>
                        </span>
                    </div>
                    <?php if ($news_item->getPhoto()): ?>
                        <div style="margin: 0 10px 5px 0; max-width: 50%; display: inline-block;" class="thumbnail">
                            <img src="<?=$news_item->getPhoto()?>" alt="<?=$news_item->getTitle()?>" style="width: 100%;" />
                        </div>
                    <?php endif; ?>
                    <p>
                        <?=$news_item->getPreviewText()?>
                    </p>
                    <p>
                        <a href="/news?id=<?=$news_item->getId()?>#comments" class="btn btn-default" role="button">Комментарии <span class="badge"><?=$news_item->getCountComments()?></span></a>
                        <a href="/news?id=<?=$news_item->getId()?>" class="btn btn-primary" role="button" style="margin-left: 10px;">Перейти к новости »</a>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>