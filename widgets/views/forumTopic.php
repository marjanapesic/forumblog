<div class="media" id="<?php echo $topic->getUniqueId()?>">
	<ul class="nav nav-pills" style="position: absolute; right: 10px;">
		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
			href="#"><i class="fa fa-angle-down"></i></a>
			<ul class="dropdown-menu pull-right">
                                            <?php $this->widget('application.modules.forum.widgets.ForumTopicEntryControls', array('object' => $topic)); ?>
                                        </ul></li>
	</ul>
	<img class="media-object img-rounded pull-left"
		data-src="holder.js/32x32" alt="32x32"
		style="width: 32px; height: 32px;"
		src="<?php echo $topic->createdBy->getProfileImage()->getUrl(); ?>">

	<!-- show content -->
	<div class="media-body">
		<a href="<?php echo $topic->getUrl()?>"><strong><?php echo $topic->title; ?>
                                    </strong></a> <br /> <span
			class="time"><?php echo Yii::t('ForumModule.views_index_index', 'started by')?> </span> <?php echo " ".$topic->createdBy->username;?> 
                            
                                    <span class="time"><?php echo Yii::t('ForumModule.views_index_index', 'last reply by')?> </span> <?php echo " ".$topic->getLastEntry()->createdBy->username;?> 
  
                                    <span class="time"
			title="<?php echo $topic->getLastEntry()->created_at;; ?>"><?php echo $topic->getLastEntry()->created_at; ?></span>
        
        <?php if ($topic->content->container instanceof Space): ?>
                    <?php echo Yii::t('ForumModule.views_index_index', 'in'); ?> <strong><a href="<?php echo $topic->content->container->getUrl(); ?>"><?php echo CHtml::encode($topic->content->container->name); ?></a></strong>
                <?php endif; ?>
	</div>
</div>