<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 * @var \Lod\News\NewsItem $news_item
 */
$news_item = $this->getData()['news_item'];
?>
<script type="text/javascript" src="//vk.com/js/api/openapi.js?105"></script>
<script type="text/javascript" src="http://vk.com/js/api/share.js?90" charset="windows-1251"></script>
<script type="text/javascript">
    VK.init({apiId: 4616687, onlyWidgets: true});
    VK.Widgets.Like("vk_like", {type: "button"});
</script>
<div class="news-content breadcrumb" style="padding: 23px; font-size: 14px;">
    <div class="lead" style="white-space: pre-line; text-align: justify; font-size: 17px; line-height: 1.8;">
        <span style="display: inline-block; margin-top: -70px;">
            <?php if ($news_item->getPhoto()): ?>
                <div style="float: left; margin: 0 14px 5px 0; max-width: 50%;">
                    <img src="<?=$news_item->getPhoto()?>" alt="<?=$news_item->getTitle()?>" style="width: 100%;" />
                </div>
            <?php endif; ?>
            <?=$news_item->getFormattedText()?>
        </span>
        <div class="vk-widget">
            <div style="display: inline-block;" id="vk_like"></div>
            <div style="display: inline-block; line-height: 0; margin-left: -23px;">
                <script>
                    document.write(VK.Share.button(false,{type: "link", text: "Поделиться"}));
                </script>
            </div>
        </div>
    </div>

</div>