<?php echo CHtml::hiddenField('fileUploaderHiddenGuidField'.$id, "", array('id' => 'fileUploaderHiddenGuidField'.$id)); ?>

<div class="modal fade" id="addImageModal<?php echo $id?>" tabindex="-1"
	role="dialog" aria-labelledby="addImageModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="addImageModalLabel<?php echo $id?>"><?php echo Yii::t('ForumModule.widgets_views_markdown', 'Add image/file');?></h4>
			</div>
			<div class="modal-body">

				<div id="addImageModalUploadForm<?php echo $id?>">
					<input id="fileUploaderButton<?php echo $id?>"
						class="btn btn-primary" type="file" name="files[]"
						data-url="<?php echo Yii::app()->createUrl('//file/file/upload', array()); ?>"
						multiple>
				</div>

				<div id="addImageModalProgress<?php echo $id?>">
					<strong><?php echo Yii::t('ForumModule.widgets_views_markdown', 'Please wait while uploading')."....";?></strong>
				</div>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('ForumModule.widgets_views_markdown', 'Close');?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="addLinkModal<?php echo $id?>" tabindex="-1"
	role="dialog" aria-labelledby="addLinkModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="addLinkModalLabel<?php echo $id?>"><?php echo Yii::t('ForumModule.widgets_views_markdown', 'Add link');?></h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="addLinkTitle"><?php echo Yii::t('ForumModule.widgets_views_markdown', 'Link title');?></label>
					<input type="text" class="form-control"
						id="addLinkTitle<?php echo $id?>" placeholder="Title of your link">
				</div>
				<div class="form-group">
					<label for="addLinkTarget<?php echo $id?>"><?php echo Yii::t('ForumModule.widgets_views_markdown', 'Target');?></label>
					<input type="text" class="form-control"
						id="addLinkTarget<?php echo $id?>"
						placeholder="Enter page title or url (e.g. http://example.com)">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo Yii::t('ForumModule.widgets_views_markdown', 'Close');?></button>
				<button type="button" id="addLinkButton<?php echo $id?>"
					class="btn btn-primary"><?php echo Yii::t('ForumModule.widgets_views_markdown', 'Add link');?></button>
			</div>
		</div>
	</div>
</div>