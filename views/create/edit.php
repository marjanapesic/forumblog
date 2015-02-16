
<div class="container">

	<div class="row">
<div class="col-md-12">

    <div class="panel panel-default">
        <div class="panel-body">

   
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'forum-topic-create-form',
                'enableAjaxValidation' => false,
            ));
            ?>

            <?php // echo $form->errorSummary($page); ?>

          
                <div class="form-group">
                    <?php // echo $form->labelEx($page, 'title'); ?>
                    <?php echo $form->textField($model, 'title', array('class' => 'form-control', 'placeholder' => Yii::t('ForumModule.base', 'New page title'))); ?>
                    <?php echo $form->error($model, 'title'); ?>
                </div>
           


            <div class="form-group">
                <?php // echo $form->labelEx($revision, 'content'); ?>
                <?php echo $form->textArea($model, 'message', array('class' => 'form-control', 'id' => 'txtWikiPageContent', 'rows' => '15', 'placeholder' => Yii::t('ForumModule.base', 'Content'))); ?>

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
            
             <?php echo $form->labelEx($model, 'space'); ?>
            <?php echo $form->textField($model, 'space', array('class' => 'form-control', 'id' => 'space_select')); ?>
            <?php
            $this->widget('application.modules_core.space.widgets.SpacePickerWidget', array(
                'spaceSearchUrl' => $this->createUrl('//forum/forum/searchSpace', array('keyword' => '-keywordPlaceholder-', 'guid'=>Yii::app()->user->guid)),
                'inputId' => 'space_select',
                'model' => $model,
                'attribute' => 'space',
                'maxSpaces' => 1
            ));?>

            <?php echo CHtml::submitButton(Yii::t('ForumModule.base', 'Save'), array('class' => 'btn btn-primary')); ?>
            <?php $this->endWidget(); ?>

        </div>
    </div>   
</div>
</div>
</div>

<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->getModule()->getAssetsUrl(); ?>/bootstrap-markdown/css/bootstrap-markdown.min.css">
<script src="<?php echo $this->getModule()->getAssetsUrl(); ?>/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script>
    wikiPreviewUrl = "<?php echo Yii::app()->createUrl('//forum/create/preview', array());; ?>";
</script>    
<?php var_dump($this->getModule()->getAssetsUrl()); ?>
<script src="<?php echo $this->getModule()->getAssetsUrl(); ?>/edit.js"></script>
