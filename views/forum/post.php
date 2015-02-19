<div class="panel panel-default post" id="<?php echo $post->getUniqueId(); ?>">
    <div class="panel-body">
        <?php $this->beginContent('application.modules.forum.views.forum_layout', array('post' => $post)); ?>

        <div class="wall-entry">
            <span id="post-content-<?php echo $post->id; ?>" style="display: block;">
                <?php echo nl2br(trim($post->message)); ?>
            </span>
        </div>
        
        <?php $this->endContent(); ?>
    </div>
</div>