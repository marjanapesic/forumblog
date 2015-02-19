<div class="panel panel-default post"
	id="<?php echo $post->getUniqueId(); ?>">
	<div class="panel-body">
        <?php $this->beginContent('application.modules.forum.views.forum_layout', array('post' => $post)); ?>

        <?php 
        $form = $this->beginWidget('CActiveForm', array(
            'enableAjaxValidation' => false,
        ));?>
        
        <div class="form-group">
            <?php echo $form->textArea($post, 'message', array('class' => 'form-control', 'id' => 'pageContent'.$post->id, 'rows' => '5', 'placeholder' => Yii::t('ForumModule.base', 'Content'))); ?>
            <?php $this->widget('application.modules.forum.widgets.MarkdownWidget', array(
                    'form' => $form,
                    'id' => $post->id
                  ));
                  echo HHtml::ajaxButton(Yii::t('ForumModule.base', 'Save'), array(
                    '//forum/forum/postEdit',
                    'id' => $post->id
                  ), array('type' => 'POST','success' => 'function(html){ $("#' . $post->getUniqueId() . '").replaceWith(html); }'
                  ), array('class' => 'btn btn-primary'));
             ?>
        </div>
        <?php $this->endWidget();?>     
        <?php $this->endContent(); ?>
    </div>
</div>