<div class="media" id="<?php echo $topic->getUniqueId()?>">

	<ul class="nav nav-pills" style="position: absolute; right: 10px;">
		<li class="dropdown">
		  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-angle-down"></i></a>
		  <ul class="dropdown-menu pull-right">
            <?php $this->widget('application.modules.forum.widgets.ForumTopicEntryControls', array('object' => $topic)); ?>
           </ul>
         </li>
	</ul>
	
	<img class="media-object img-rounded pull-left"
		data-src="holder.js/32x32" alt="32x32"
		style="width: 32px; height: 32px;"
		src="<?php echo $topic->createdBy->getProfileImage()->getUrl(); ?>">

	<!-- show content -->
	<div class="media-body">
	
	    <?php if($editable){?>
	        <?php  $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'forum-topic-form',
                        'enableAjaxValidation' => false,
                    ));?>
	        <div id="<?php echo $topic->getUniqueId()."_title"?>" name="<?php echo $topic->id;?>" class="form-control autosize topicAnchor" contenteditable="true"><?php echo $topic->title;?></div>
	        <?php echo HHtml::hiddenField('title', $topic->title, array('id' => $topic->getUniqueId()."_titleHidden"));?>
	        <?php echo HHtml::hiddenField('id', $topic->id);?>
	        <?php echo HHtml::ajaxButton(Yii::t('ForumModule.base', 'Save'), array('//forum/forum/topicEdit'), array(
            'type' => 'POST',
            'success' => 'function(html){ $("#' . $topic->getUniqueId(). '").replaceWith(html); }',
                ), array('class' => 'btn btn-primary', 'style'=> 'display: none;', 'id' => $topic->getUniqueId()."_title_submit")); ?>
                <?php $this->endWidget(); ?>
	    <?php }
	    else { ?>
		<a href="<?php echo $topic->getUrl()?>"><strong><?php echo $topic->title; ?></strong></a>
		<?php } ?>
		<br/> 
		<span class="time"><?php echo Yii::t('ForumModule.views_index_index', 'started by')?> </span> <?php echo " ".$topic->createdBy->username;?> 
                            
        <span class="time"><?php echo Yii::t('ForumModule.views_index_index', 'last reply by')?> </span> <?php echo " ".$topic->getLastEntry()->createdBy->username;?> 
  
        <span class="time" title="<?php echo $topic->getLastEntry()->created_at; ?>"><?php echo $topic->getLastEntry()->created_at; ?></span>
	</div>

	<hr/>
</div>
<script>
$(document).ready(function () {

	$('.topicAnchor').keydown(function (event) {
		
	    if(event.keyCode == 13) {
	    	event.preventDefault();
		    var txt= $(event.target).html();
	    	$('#'+event.target.id+"Hidden").val(txt);
	    	$('#'+event.target.id+"_submit").click();
        	
		}
	 
	});
});
</script>