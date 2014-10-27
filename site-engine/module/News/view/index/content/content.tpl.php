<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
/** @var \Lod\News\NewsItem $news_item */
$news_item = $this->getData()['news_item'];
?>
<div class="news-content">
    <div class="lead" style="white-space: pre-line; text-align: justify;">
        <?php if ($news_item->getPhoto()): ?>
            <div style="float: left; margin: 0 14px 5px 0; max-width: 50%;">
                <img src="<?=$news_item->getPhoto()?>" alt="<?=$news_item->getTitle()?>" style="width: 100%;" />
            </div>
        <?php endif; ?>
        <?=$news_item->getFormattedText()?>
    </div>

</div>