
<div class="media">

	<!-- start: show post entry options -->
    <?php $this->widget('application.modules.forum.widgets.ForumPostEntryControls', array('object' => $post)); ?>


	<!-- end: show wall entry options -->
	<a href="<?php echo $post->createdBy->getProfileUrl(); ?>"
		class="pull-left"> <img class="media-object img-rounded user-image"
		alt="40x40" data-src="holder.js/40x40"
		style="width: 40px; height: 40px;"
		src="<?php echo $post->createdBy->getProfileImage()->getUrl(); ?>"
		width="40" height="40" />
	</a>

	<div class="media-body">
	
		<!-- show username with link and creation time-->
		<h4 class="media-heading">
		
		    <?php if ($post->createdBy):?>
			<a href="<?php echo $post->createdBy->getProfileUrl(); ?>"><?php echo CHtml::encode($post->createdBy->displayName); ?></a>
			<small>
			     <?php echo HHtml::timeago($post->created_at); ?>
                        
                 <?php if ($post->created_at != $post->updated_at): ?>
                          (<?php echo Yii::t('ForumModule.views_forum_post_layout', 'Updated :timeago', array (':timeago'=>HHtml::timeago($post->updated_at))); ?>)
                  <?php endif; ?>
   
            </small>
            <?php endif; ?>
		</h4>
		<h5><?php echo CHtml::encode($post->createdBy->profile->title); ?></h5>

	</div>


	<!-- show content -->
	<div class="content"
		id="wall_content_<?php echo $post->getUniqueId(); ?>">
                <?php echo $content; ?>
    </div>

</div>

<script type="text/javascript">

    
    $(window).load(function () {

        var postWidth = $('#post-content-<?php echo $post->id; ?>').outerWidth();
        var parentWidth = $('#post-content-<?php echo $post->id; ?>').parent().outerWidth();

        var postHeight = $('#post-content-<?php echo $post->id; ?>').outerHeight();
        
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