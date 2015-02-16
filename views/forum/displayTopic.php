<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="s2-streamContent">

				<div class="panel">
					<strong><?php echo $topic->title ?></strong>
					<!-- show space name -->
                    <?php if ( $topic->space != null ): ?>
                       - <a
						href="<?php echo $topic->space->getUrl(); ?>"><small><span
							class="time"><?php echo CHtml::encode($topic->space->name); ?></span></small></a>
                    <?php endif; ?>                  
                </div>

				<div class="wall-entry">
                        <?php foreach ($posts as $post) {?>
                            
                            <?php  
                            
                            echo Yii::app()->getController()->renderPartial('application.modules.forum.widgets.views.forumPost', array(
                                'post' => $post,  'justEdited' => false
                            ));
                      
                            ?>
                           
                        <?php }?>
                      
                 </div>
                 
                 <div class="wall-entry">
                 <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'id' => 'forum-post-form',
                        'enableAjaxValidation' => false,
                    ));
                    ?>
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
 postPreviewUrl = "<?php echo Yii::app()->createUrl('//forum/forum/preview', array());; ?>";
</script>    

<script src="<?php echo $this->getModule()->getAssetsUrl(); ?>/edit.js"></script>
