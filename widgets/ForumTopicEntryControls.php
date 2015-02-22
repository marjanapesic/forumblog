<?php

/**
 * ForumTopicEntryControls is a instance of StackWidget 
 *
 * @package humhub.modules.forum.widgets
 * @since 0.5
 */
class ForumTopicEntryControls extends HWidget {

    /**
     * Object derived from HActiveRecordContent
     *
     * @var type
     */
    public $object = null;

    /**
     * Executes the widget.
     */
    public function run()
    {
        if (($this->object->editRoute != "" && $this->object->canWrite()) || $this->object->canDelete()) {
            $this->render('forumTopicEntryControls', array(
                'object' => $this->object,
            ));
        }

    }
    
}

?>