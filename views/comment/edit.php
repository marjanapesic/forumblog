<div class="content_edit input-container" id="comment_edit_<?php echo $comment->id; ?>">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'comment-edit-form',
        'enableAjaxValidation' => false,
    ));
    ?>
    <?php //echo $form->textArea($comment, 'message', array('class' => 'form-control', 'id' => 'comment_input_' . $comment->id, 'placeholder' => Yii::t('CommentModule.views_edit', 'Edit your comment...'))); ?>

    
    
    <div class="form-group">
                <?php // echo $form->labelEx($revision, 'content'); ?>
                <?php echo $form->textArea($comment, 'message', array('class' => 'form-control', 'id' => 'txtWikiPageContent', 'rows' => '15', 'placeholder' => Yii::t('ForumModule.base', 'Content'))); ?>

                <?php echo CHtml::hiddenField('fileUploaderHiddenGuidField', "", array('id' => 'fileUploaderHiddenGuidField')); ?>
                <div class="modal fade" id="addImageModal" tabindex="-1" role="dialog" aria-labelledby="addImageModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="addImageModalLabel">Add image/file</h4>
                            </div>
                            <div class="modal-body">

                                <div id="addImageModalUploadForm">
                                    <input id="fileUploaderButton" class="btn btn-primary" type="file" name="files[]"
                                           data-url="<?php echo Yii::app()->createUrl('//file/file/upload', array()); ?>" multiple>
                                </div>

                                <div id="addImageModalProgress">
                                    <strong>Please wait while uploading....</strong>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="addLinkModal" tabindex="-1" role="dialog" aria-labelledby="addLinkModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="addLinkModalLabel">Add link</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="addLinkTitle">Link title</label>
                                    <input type="text" class="form-control" id="addLinkTitle" placeholder="Title of your link">
                                </div>
                                <div class="form-group">
                                    <label for="addLinkTarget">Target</label>
                                    <input type="text" class="form-control" id="addLinkTarget" placeholder="Enter wiki page title or url (e.g. http://example.com)">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="button" id="addLinkButton" class="btn btn-primary">Add link</button>
                            </div>
                        </div>
                    </div>
                </div>

       </div>
   
    
    
    <!-- create contenteditable div for HEditorWidget to place the data
    <div id="comment_input_<?php echo $comment->id; ?>_contenteditable" class="form-control atwho-input" contenteditable="true"><?php echo HHtml::enrichText($comment->message); ?></div> -->


    <?php
    /* Modify textarea for mention input */
  /*  $this->widget('application.widgets.HEditorWidget', array(
        'id' => 'comment_input_' . $comment->id,
        'inputContent' => $comment->message,
    ));*/
    ?>  

    <?php
    echo HHtml::ajaxButton('Save', array('//forum/comment/edit', 'id' => $comment->id), array(
        'type' => 'POST',
        'success' => 'function(html){  $("#postComment_' . $comment->id . '").replaceWith(html); }',
            ), array('class' => 'btn btn-primary', 'id' => 'comment_edit_post_' . $comment->id));
    ?>
 

    <?php $this->endWidget(); ?>
</div>

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->getModule()->getAssetsUrl(); ?>/bootstrap-markdown/css/bootstrap-markdown.min.css">
<script src="<?php echo $this->getModule()->getAssetsUrl(); ?>/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script>
    postPreviewUrl = "<?php echo Yii::app()->createUrl('//forum/create/preview', array());; ?>";
</script>    

<script src="<?php echo $this->getModule()->getAssetsUrl(); ?>/edit.js"></script>
		

<script type="text/javascript">

    // add attribute to manage the enter/submit event (prevent submit, if user press enter to insert an item from atwho plugin)
    $('#comment_input_<?php echo $comment->id; ?>_contenteditable').attr('data-submit', 'true');

    // Fire click event for comment button by typing enter
    $("#comment_input_<?php echo $comment->id; ?>_contenteditable").keydown(function(event) {


        // by pressing enter without shift
        if (event.keyCode == 13 && event.shiftKey == false) {

            // prevent default behavior
            event.cancelBubble = true;
            event.returnValue = false;
            event.preventDefault();


            // check if a submit is allowed
            if ($('#comment_input_<?php echo $comment->id; ?>_contenteditable').attr('data-submit') == 'true') {

                // hide all tooltips (specially for file upload button)
                $('.tt').tooltip('hide');

                // check if a submit is allowed
                if ($('#comment_input_<?php echo $comment->id; ?>_contenteditable').attr('data-submit') == 'true') {

                    // get plain input text from contenteditable DIV
                    $('#comment_input_<?php echo $comment->id; ?>').val(getPlainInput($('#comment_input_<?php echo $comment->id; ?>_contenteditable').clone()));

                    // set focus to submit button
                    $('#comment_edit_post_<?php echo $comment->id; ?>').focus();

                    // emulate the click event
                    $('#comment_edit_post_<?php echo $comment->id; ?>').click();

                }
            }
        }

        return event.returnValue;

    });

    $('#comment_input_<?php echo $comment->id; ?>_contenteditable').on("shown.atwho", function(event, flag, query) {
        // prevent the submit event, by changing the attribute
        $('#comment_input_<?php echo $comment->id; ?>_contenteditable').attr('data-submit', 'false');
    });

    $('#comment_input_<?php echo $comment->id; ?>_contenteditable').on("hidden.atwho", function(event, flag, query) {

        var interval = setInterval(changeSubmitState, 10);

        // allow the submit event, by changing the attribute (with delay, to prevent the first enter event for insert an item from atwho plugin)
        function changeSubmitState() {
            $('#comment_input_<?php echo $comment->id; ?>_contenteditable').attr('data-submit', 'true');
            clearInterval(interval);
        }
    });

</script>