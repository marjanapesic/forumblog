<?php 

class CommentFormWidget extends HWidget
{

    /**
     * Content Object
     */
    public $object;

    /**
     * Executes the widget.
     */
    public function run()
    {

        $modelName = get_class($this->object);
        $modelId = $this->object->id;
        $id = $modelName . "_" . $modelId;

        $this->render('commentForm', array(
            'modelName' => $modelName,
            'modelId' => $modelId,
            'id' => $modelName . "_" . $modelId,
        ));
    }

}
?>