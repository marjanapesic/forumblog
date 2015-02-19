<?php

/**
 *
 * @package humhub.modules.forum.widgets
 * @since 0.10
 */
class MarkdownWidget extends HWidget {

    /**
     * Object derived from HActiveRecordContent
     *
     * @var type
     */
    public $object = null;

    public $form = null;
    
    public $id = null;
    
    public function init(){

        if(!$this->id)
            $this->id = $this->object->getUniqueId();

        Yii::app()->clientScript->registerCssFile($this->getController()->getModule()->getAssetsUrl()."/bootstrap-markdown/css/bootstrap-markdown.min.css");
        Yii::app()->clientScript->registerScriptFile($this->getController()->getModule()->getAssetsUrl()."/bootstrap-markdown/js/bootstrap-markdown.js");
        Yii::app()->clientScript->setJavascriptVariable(
            "previewUrl".$this->id, Yii::app()->getController()->createUrl('//forum/forum/preview', array())
        );
        Yii::app()->clientScript->registerScriptFile($this->getController()->getModule()->getAssetsUrl()."/edit.js");
        
       
        Yii::app()->clientScript->registerScript(
        "addMarkdown" . $this->id
        , "addMarkdown('" .$this->id . "');"
            , CClientScript::POS_READY
        );
      
        $this->render('markdown', array(
            'object' => $this->object,
            'id' => $this->id,
            'form' => $this->form
        ));
    }
}