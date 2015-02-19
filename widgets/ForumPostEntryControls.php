<?php

class ForumPostEntryControls extends StackWidget {

    /**
     * Object derived from HActiveRecordContent
     *
     * @var type
     */
    public $object = null;

    public function init(){
        
        $message = Yii::t('ForumBlog.widgets_views_deleteLink', 'Do you really want to delete this post? All likes and comments will be lost!');
        if($this->object->isFirstPost)
            $message .= " ".Yii::t('ForumBlog.widgets_views_deleteLink', 'By deleting this post the <strong>whole topic will be deleted</strong>!');
        $this->addWidget('application.modules.forum.widgets.DeleteLinkWidget', array(
            'object' => $this->object,
            'title' => Yii::t('ForumBlog.widgets_views_deleteLink', '<strong>Confirm</strong> post deletion'),
            'message' => $message
            )
        );
        
        $this->addWidget('application.modules.forum.widgets.EditLinkWidget', array(
            'object' => $this->object
            )
        );
    }
    
}

?>