<div class="media" id="<?php echo $topic->getUniqueId()?>">

    <?php $this->beginContent('application.modules.forum.views.forum_topic_layout', array('topic' => $topic)); ?>	
	
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

		
     <?php $this->endContent(); ?>
	
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