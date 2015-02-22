
<div class="container">

	<div class="row">
<div class="col-md-12">

    <div class="panel panel-default">
        <div class="panel-body">

   
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'forum-topic-create-form',
                'enableAjaxValidation' => true,
            ));
            ?>

            <?php // echo $form->errorSummary($page); ?>
           <h4>
            <strong><?php echo Yii::t('ForumModule.views_forum_edit', "Create a new forum topic");?></strong>
          </h4>
          <br/>
                <div class="form-group">
                    <?php  echo $form->labelEx($model, 'title'); ?>
                    <?php echo $form->textField($model, 'title', array('class' => 'form-control', 'placeholder' => Yii::t('ForumModule.base', 'New page title'))); ?>
                    <?php echo $form->error($model, 'title'); ?>
                </div>
           
            
            <?php echo $form->labelEx($model, 'message');?>
            <?php echo $form->textArea($model, 'message', array('class' => 'form-control', 'id' => 'pageContentnewTopic', 'rows' => '23', 'placeholder' => Yii::t('ForumModule.base', 'Content')));?> 
            <?php $this->widget('application.modules.forum.widgets.MarkdownWidget', array('id' => 'newTopic')); ?>
            
             <?php //echo $form->labelEx($model, 'space'); ?>
            <?php //echo $form->textField($model, 'space', array('class' => 'form-control', 'id' => 'space_select')); ?>
            <?php
           /* $this->widget('application.modules_core.space.widgets.SpacePickerWidget', array(
                'spaceSearchUrl' => $this->createUrl('//forum/index/searchSpace', array('keyword' => '-keywordPlaceholder-', 'guid'=>Yii::app()->user->guid)),
                'inputId' => 'space_select',
                'model' => $model,
                'attribute' => 'space',
                'maxSpaces' => 1
            ));*/?>

            <?php echo CHtml::submitButton(Yii::t('ForumModule.base', 'Save'), array('class' => 'btn btn-primary')); ?>
            <?php $this->endWidget(); ?>

        </div>
    </div>   
</div>
</div>
</div>