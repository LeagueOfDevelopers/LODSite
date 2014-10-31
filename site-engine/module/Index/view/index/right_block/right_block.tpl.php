<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
$comments = $this->getData()['comments_list'];
?>
<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">

    <div class="page-header">
        <h2><small>Последние комментарии</small></h2>
    </div>

    <div class="list-group">
        <?php /** @var \Lod\News\Comments\CommentItem\CommentItem $comment */
        foreach ($comments as $comment): ?>
            <?php
            $user = $comment->getUserObject();
            $news_title = $comment->getObject()['news_title'];
            ?>
            <div class="list-group-item preview-comment">
                <h4 class="list-group-item-heading">
                    <div class="profile-img">
                        <a target="_blank" href="/profile?id=<?=$user->getId()?>">
                            <div class="profile-img-wrapper" style="width: 26px; height: 26px; background-image: url(<?=$user->getPhotoLink()?>);"></div>
                        </a>
                    </div>
                    <a href="/news?id=<?=$comment->getNewsId()?>#comment_<?=$comment->getId()?>"><?=$user->getViewName()?></a>
                    <?php if ($user->isOnline()):?>
                        <span data-toggle="tooltip" data-placement="right" title="Online" class="online-pointer"></span>
                    <?php endif; ?>
                </h4>
                <div class="news-date">
                    <a target="_blank" style="color: #909090;" href="/news?id=<?=$comment->getNewsId()?>#comment_<?=$comment->getId()?>">Добавлено <?=$comment->getDate()?></a>
                </div>
                <div class="list-group-item-text item-limit" style="opacity: 0; max-height: 0px; overflow: hidden; position: relative; padding-bottom: 19px;">
                    <?=$comment->getFormattedText()?>
                    <span class="comment-overlay"></span>
                </div>
                <div class="news-date">
                    <span>
                        К новости <a data-toggle="tooltip" data-placement="top" title="Человечеству грозит мощная магнитная буря" href="/news?id=<?=$comment->getNewsId()?>"><?=trim($news_title)?></a>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (!count($comments)): ?>
            <div class="list-group-item preview-comment" style="text-align: center;">
                <span>Список пуст</span>
            </div>
        <?php endif; ?>
    </div>

</div>