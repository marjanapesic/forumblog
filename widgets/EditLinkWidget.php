<?php

class EditLinkWidget extends HWidget
{

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
        if ($this->object->editRoute != "" && $this->object->content->canWrite()) {
            $this->render('editLink', array(
                'id' => $this->object->content->object_id,
                'object' => $this->object,
                'editRoute' => $this->object->editRoute
            ));
        }
    }

}

?>