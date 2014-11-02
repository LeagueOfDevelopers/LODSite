<?php
/**
 * @var $this \Lod\Core\View\AbstractView
 */
/** @var \Lod\News\NewsItem $news_item */
$news_item = $this->getData()['news_item'];
$comments = $news_item->getCommentsObject()->getComments(ASC);

/** @var \Lod\User\User $cur_user */
$cur_user = $this->getData()['user'];
?>
<?php if ($cur_user->isBan()): ?>
    <div class="alert alert-danger" role="alert">
        Вы <a class="alert-link">забанены</a> и не можете отправлять комментарии!
    </div>
<?php endif; ?>
<div class="panel panel-default">
    <a name="comments"></a>
    <script type="text/javascript">
        var All = {
            news_id: <?=$news_item->getId()?>
        };
    </script>
    <div class="panel-heading">
        <h3 class="panel-title">Комментарии (<?=$news_item->getCountComments()?>):</h3>
    </div>
    <div class="panel-body" style="overflow: hidden;">
        <?php /** @var \Lod\News\Comments\CommentItem\CommentItem $comment */
        foreach ($comments as $comment): ?>
            <?php
            $user = $comment->getUserObject();
            $parent_flag = !!$comment->getParentId();
            $is_my_comment = $comment->getUserId() == $cur_user->getId();
            ?>
            <div class="media" id="comment_<?=$comment->getId()?>" style="padding-bottom: 12px; overflow: visible;">
                <?php if ($comment->canDelete() && $is_my_comment || $cur_user->getAccessLevel() >= 8): ?>
                <span onclick="Comments.deleteComment(<?=$comment->getId()?>)" class="glyphicon glyphicon-remove comment-remove" data-toggle="tooltip" data-placement="left" title="" data-original-title="Удалить комментарий"></span>
                <?php endif; ?>
                <a name="comment_<?=$comment->getId()?>"></a>
                <a class="pull-left" href="/profile?id=<?=$comment->getUserId()?>">
                    <div class="profile-img">
                        <div class="profile-img-wrapper-comment" id="profile-image" style="background-image: url(<?=$user->getPhotoLink()?>);"></div>
                    </div>
                </a>
                <div class="media-body">
                    <h4 class="media-heading">
                        <a target="_blank" href="/profile?id=<?=$comment->getUserId()?>">
                            <?=$user->getViewName()?></a>
                        <?php if ($user->isOnline()):?>
                            <span data-toggle="tooltip" data-placement="right" title="Online" class="online-pointer"></span>
                        <?php endif; ?>
                        <small>
                            <span>написал<?=($user->getSex() == 'b' ? '' : 'a')?></span>
                            <?php if ($parent_flag): ?>
                                <span>ответ пользователю</span>
                                <a target="_blank" href="/profile?id=<?=$comment->getParentId()?>"><?=$comment->getParentViewName()?></a>
                            <?php endif; ?>
                        </small>
                        <small>(<?=$comment->getDate()?>) <a href="#comment_<?=$comment->getId()?>">#</a></small>

                    </h4>
                </div>
                <div class="comment-text"><?=$comment->getFormattedText()?></div>
                <div class="comment-reply">
                    <a href="/" onclick="Comments.reply('<?=$user->getViewName()?>', <?=$comment->getUserId()?>); return !1;">Ответить</a>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if (!count($comments)): ?>
            <div style="padding: 12px 0; text-align: center; font-size: 16px;">
                Комментариев пока нет.
            </div>
        <?php endif; ?>
    </div>
</div>