<?php

class ForumPostEntryControls extends HWidget {

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
            $this->render('forumPostEntryControls', array(
                'object' => $this->object,
            ));
        }    
    }
    
}

?>