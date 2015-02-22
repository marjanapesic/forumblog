<div class="media" id="<?php echo $topic->getUniqueId()?>">

    <?php $this->beginContent('application.modules.forum.views.forum_topic_layout', array('topic' => $topic)); ?>	
	
		<a href="<?php echo $topic->getUrl()?>"><strong><?php echo $topic->title; ?></strong></a>

		
     <?php $this->endContent(); ?>
	
</div>