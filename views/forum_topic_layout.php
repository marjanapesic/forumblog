    <?php $this->widget('application.modules.forum.widgets.ForumTopicEntryControls', array('object' => $topic)); ?>
	
	
	<img class="media-object img-rounded pull-left"
		data-src="holder.js/32x32" alt="32x32"
		style="width: 32px; height: 32px;"
		src="<?php echo $topic->getLastEntry()->createdBy->getProfileImage()->getUrl(); ?>">

	<!-- show content -->
	<div class="media-body">
	
	    <?php echo $content; ?>
		
		<!-- number of replies -->
		<a href="<?php echo $topic->getUrl()?>" style="text-decoration: underline;color: blue;"><?php if(($count = $topic->postsCount()) == 1) echo $count." ". Yii::t("ForumModule.views_forum_topicEntry","reply"); else echo $count." ". Yii::t("ForumModule.views_forum_topicEntry","replies"); ?></span></a>
		<br/> 
		
		<!-- started -->
		<span class="time"><?php echo Yii::t('ForumModule.views_index_index', 'started by')?> </span>
		<a href="<?php echo $topic->createdBy->getUrl();?>"> <?php echo " ".$topic->createdBy->username;?></a>                 
        
        <!-- last reply -->
        <span class="time"><?php echo Yii::t('ForumModule.views_index_index', 'last reply by')?> </span> 
        <a href="<?php echo $topic->getLastEntry()->createdBy->getUrl();?>"> <?php echo " ".$topic->getLastEntry()->createdBy->username;?> </a>
        <span class="time" title="<?php echo $topic->getLastEntry()->created_at; ?>"><?php echo $topic->getLastEntry()->created_at; ?></span>
        
	</div>

	<hr/>