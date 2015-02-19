<div class="well well-small" style="display: none;" id="postComment_<?php echo $id; ?>">
    <div class="comment" id="comments_area_<?php echo $id; ?>">
        <?php if ($isLimited): ?>
            <?php
            // Create an ajax link, which loads all comments upon request
            $showAllLabel = Yii::t('ForumModule.widgets_views_comments', 'Show all {total} comments.', array('{total}' => $total));
            $reloadUrl = CHtml::normalizeUrl(Yii::app()->createUrl('forum/comment/show', array('model' => $modelName, 'id' => $modelId)));
            echo HHtml::ajaxLink($showAllLabel, $reloadUrl, array(
                'success' => "function(html) { $('#comments_area_" . $id . "').html(html); }",
                    ), array('id' => $id . "_showAllLink", 'class' => 'show show-all-link'));
            ?>
            <hr>
        <?php endif; ?>

        <?php foreach ($comments as $comment) : ?>
            <?php $this->widget('application.modules.forum.widgets.ShowComment', array('comment' => $comment)); ?>
        <?php endforeach; ?>
    </div>

    <?php $this->widget('application.modules.forum.widgets.CommentFormWidget', array('object' => $object)); ?>

</div>
<?php /* END: Comment Create Form */ ?>