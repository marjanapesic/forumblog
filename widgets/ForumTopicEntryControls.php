<?php

/**
 * ForumTopicEntryControls is a instance of StackWidget 
 *
 * @package humhub.modules.forum.widgets
 * @since 0.5
 */
class ForumTopicEntryControls extends StackWidget {

    /**
     * Object derived from HActiveRecordContent
     *
     * @var type
     */
    public $object = null;

    public function init(){
        
        $this->addWidget('application.modules.forum.widgets.DeleteLinkWidget', array(
            'object' => $this->object,
            'title' => Yii::t('ForumBlog.widgets_views_deleteLink', '<strong>Confirm</strong> topic deletion'),
            'message' => Yii::t('ForumBlog.widgets_views_deleteLink', 'Do you really want to delete this topic? All posts, likes and comments will be lost!')
            )
        );
        
        $this->addWidget('application.modules.forum.widgets.EditLinkWidget', array(
            'object' => $this->object
            )
        );
    }
    
}

?>