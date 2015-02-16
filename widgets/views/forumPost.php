<?php
/**
 * This view represents a wall entry of a post.
 * Used by PostWidget to show Posts inside a wall.
 *
 * @property User $user the user which created this post
 * @property Post $post the current post
 *
 * @package humhub.modules.post
 * @since 0.5
 */
?>


<div class="panel panel-default post" id="<?php echo $post->getUniqueId(); ?>">
    <div class="panel-body">
        <?php $this->beginContent('application.modules.forum.views.forum_layout', array('object' => $post)); ?>
        <span id="post-content-<?php echo $post->id; ?>" style="margin-bottom: 5px; display: block;">
            <?php print nl2br($post->message); ?>
        </span>
        <?php $this->endContent(); ?>
    </div>
</div>

<script type="text/javascript">

    
    $(window).load(function () {


        var postHeight = $('#post-content-<?php echo $post->id; ?>').height();
        var postWidth = $('#post-content-<?php echo $post->id; ?>').outerWidth();
        var parentWidth = $('#post-content-<?php echo $post->id; ?>').parent().outerWidth();

        if (postHeight > 420) {
            $('#post-content-<?php echo $post->id; ?>').css({'display': 'block', 'max-height': '420px'});
            $('#post-content-<?php echo $post->id; ?>').css({'overflow-y': 'scroll'})
        }

        if(postWidth > parentWidth) {
        	 $('#post-content-<?php echo $post->id; ?>').css({'display': 'block', 'max-width': parentWidth+'px'});
        	 $('#post-content-<?php echo $post->id; ?>').css({'overflow-x': 'scroll'})
        }
    });

</script>