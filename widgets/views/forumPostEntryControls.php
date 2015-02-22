<ul class="nav nav-pills" style="position: absolute; right: 10px;">
	<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown"
		href="#"><i class="fa fa-angle-down"></i></a>
		<ul class="dropdown-menu pull-right">
            
            <?php if ($object->editRoute != "" && $object->canWrite()):?>
            <li>
                <?php
                echo HHtml::ajaxLink('<i class="fa fa-pencil"></i> ' . Yii::t('ForumModule.base', 'Edit'), 
                    Yii::app()->createUrl($object->editRoute, array('id' => $object->id)),
                    array(
                        'success' => "js:function(html){ $('.preferences .dropdown').removeClass('open'); $('#" . $object->getUniqueId() . "').replaceWith(html); }"
                ));
                ?>
            </li>
            <?php endif;?>
            
            <?php if ($object->canDelete()):?>
            <li>
                <!-- load modal confirm widget -->
                <?php 
                    $message = Yii::t('ForumModule.widgets_views_forumPostEntryControls', 'Do you really want to delete this post?');
                    if($object->isFirstPost){
                        $message .= " ".Yii::t('ForumModule.widgets_views_forumPostEntryControls', 'By deleting this post the <strong>whole topic will be deleted</strong>!');
                    }
                     $this->widget('application.widgets.ModalConfirmWidget', array(
                    'uniqueID' => 'modal_postdelete_'. $object->id,
                    'linkOutput' => 'a',
                    'title' => Yii::t('ForumModule.widgets_views_forumPostEntryControls', '<strong>Confirm</strong> post deletion'),
                    'message' => $message,
                    'buttonTrue' => Yii::t('ForumModule.base', 'Delete'),
                    'buttonFalse' => Yii::t('ForumModule.base', 'Cancel'),
                    'linkContent' => '<i class="fa fa-trash-o"></i> ' . Yii::t('ForumBlog.base', 'Delete'),
                    'linkHref' => Yii::app()->createUrl("//forum/forum/delete", array('model' => get_class($object), 'id' => $object->id)),
                    'confirmJS' => 'function(jsonResp) {jsonResp = JSON.parse(jsonResp); if (jsonResp["redirect"]) {window.location.href =jsonResp["redirect"];} if(jsonResp["success"] == true) {$("#'.$object->getUniqueId().'").hide();} } '
                ));
            
                ?>
            </li>
            <?php endif;?>
		</ul>
	</li>
</ul>