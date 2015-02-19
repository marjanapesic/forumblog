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
        //$firstPostNotice = (isset($model->isFirstPost) && $model->isFirstPost) ? " ".Yii::t('ForumBlog.widgets_views_deleteLink', 'By deleting this post the whole topic will be deleted') : '';
        $this->widget('application.widgets.ModalConfirmWidget', array(
        'uniqueID' => 'modal_postdelete_'. $id,
        'linkOutput' => 'a',
        'title' => $title,
        'message' => $message,
        'buttonTrue' => Yii::t('ForumBlog.widgets_views_deleteLink', 'Delete'),
        'buttonFalse' => Yii::t('ForumBlog.widgets_views_deleteLink', 'Cancel'),
        'linkContent' => '<i class="fa fa-trash-o"></i> ' . Yii::t('ForumBlog.widgets_views_deleteLink', 'Delete'),
        'linkHref' => $this->createUrl("//forum/forum/delete", array('model' => $model->content->object_model, 'id' => $id)),
        'confirmJS' => 'function(jsonResp) {jsonResp = JSON.parse(jsonResp); if(jsonResp["success"] == true) {$("#'.$model->getUniqueId().'").hide();}}'
    ));

    ?>
</li>