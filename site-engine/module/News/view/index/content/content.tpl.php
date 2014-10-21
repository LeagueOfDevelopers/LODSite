<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
/** @var \Lod\News\NewsItem $news_item */
$news_item = $this->getData()['news_item'];
?>
<div class="news-content">
    <?php if ($news_item->getPhoto()): ?>
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <a class="thumbnail" style="max-width: 100%;">
                <img src="<?=$news_item->getPhoto()?>" alt="<?=$news_item->getTitle()?>">
            </a>
        </div>
    </div>
    <?php endif; ?>
    <div class="lead" style="white-space: pre-line; overflow: hidden; text-align: justify;">
        <?=$news_item->getFormattedText()?>
    </div>

</div>