<?php

/**
 * This view shows the delete link for forum topic entries.
 * Its used by DeleteLinkWidget.
 *
 * @property String $model the model name (e.g. Post)
 * @property String $id the primary key of the model (e.g. 1)
 *
 * @package humhub.modules.forumblog
 * @since 0.5
 */
?>
<li>
    <!-- load modal confirm widget -->
    <?php 
        $firstPostNotice = $model->isFirstPost ? " ".Yii::t('ForumBlog.widgets_views_deleteLink', 'By deleting this post the whole topic will be deleted') : '';
        $this->widget('application.widgets.ModalConfirmWidget', array(
        'uniqueID' => 'modal_postdelete_'. $id,
        'linkOutput' => 'a',
        'title' => Yii::t('ForumBlog.widgets_views_deleteLink', '<strong>Confirm</strong> post deleting'),
        'message' => Yii::t('ForumBlog.widgets_views_deleteLink', 'Do you really want to delete this post? All likes and comments will be lost!').$firstPostNotice,
        'buttonTrue' => Yii::t('ForumBlog.widgets_views_deleteLink', 'Delete'),
        'buttonFalse' => Yii::t('ForumBlog.widgets_views_deleteLink', 'Cancel'),
        'linkContent' => '<i class="fa fa-trash-o"></i> ' . Yii::t('ForumBlog.widgets_views_deleteLink', 'Delete'),
        'linkHref' => $this->createUrl("//forum/forum/delete", array('model' => $model->content->object_model, 'id' => $id)),
        'confirmJS' => 'function(jsonResp) {jsonResp = JSON.parse(jsonResp); if(jsonResp["success"] == true) {$("#'.$model->getUniqueId().'").hide();}}'
    ));

    ?>
</li>