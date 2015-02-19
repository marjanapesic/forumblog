<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<?php /* BEGIN: Comment Create Form */ ?>
<div id="comment_create_form_<?php echo $id; ?>" class="comment_create">

    <?php $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'forum-post-form',
                        'enableAjaxValidation' => false,
                    ));?>
    <?php echo CHtml::hiddenField('model', $modelName); ?>
    <?php echo CHtml::hiddenField('id', $modelId); ?>
    <?php echo CHtml::textArea("message", "", array('id' => 'pageContent'.$id, 'rows' => '1', 'class' => 'form-control', 'rows' => '5', 'placeholder' => Yii::t('CommentModule.widgets_views_form', 'Write a new comment...')));?> 
    <?php $this->widget('application.modules.forum.widgets.MarkdownWidget', array('form' => $form, 'id' => $id)); ?>
    
    <?php
    echo HHtml::ajaxSubmitButton(Yii::t('CommentModule.widgets_views_form', 'Post'), CHtml::normalizeUrl(array('/forum/comment/post')), array(
            'type' => 'POST',
            'success' => "function(html) {
            
            $('#comments_area_" . $id . "').html(html);
            $('#newPortCommentForm_" . $id . "').val('').trigger('autosize.resize');
            $('#newPortCommentForm_" . $id . "_contenteditable').html('" . Yii::t('CommentModule.widgets_views_form', 'Write a new comment...') . "');
            $('#newPortCommentForm_" . $id . "_contenteditable').addClass('atwho-placeholder');
            $('#pageContent".$id."').val('');

        }",
        ), array(
            'id' => "comment_create_post_" . $id,
            'class' => 'btn btn-small btn-primary',
         
        )
    );
    ?>

  <?php $this->endWidget(); ?>

</div>