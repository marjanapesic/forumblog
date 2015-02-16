<?php

/**
 * ForumTopicEntryControls is a instance of StackWidget 
 *
 * @package humhub.modules.forumblog.widgets
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
            'object' => $this->object
            )
        );
        
        $this->addWidget('application.modules.forum.widgets.EditLinkWidget', array(
            'object' => $this->object
            )
        );
    }
    
}

?>