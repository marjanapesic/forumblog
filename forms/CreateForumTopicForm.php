<?php

/**
 * @package humhub.modules.forumblog.forms
 * @since 0.5
 */
class CreateForumTopicForm extends CFormModel {

    public $title;
    public $message;
    public $space;

    /**
     * Declares the validation rules.
     */
    public function rules() {
        return array(
            array('title, message', 'required'),
            array('space', 'checkSpace'),
            array('title', 'length', 'max' => 255),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels() {
        return array(
            'title' => Yii::t('ForumBlogModule.forms_CreateForumTopicForm', 'Forum topic title'),
            'message' => Yii::t('ForumBlogModule.forms_CreateForumTopicForm', 'Message'),
            'space' => Yii::t('ForumBlogModule.forms_CreateForumTopicForm', 'Space'),
        );
    }

    /**
     * Form Validator which checks the space field
     *
     * @param type $attribute            
     * @param type $params            
     */
    public function checkSpace($spaceGuid, $params)
    {
        
        // Check if space field is not empty
        if ($this->space != "") {
            // Try load space
            $spaces = explode(',', $this->space);
            $this->space = $spaces[0];
            $space = Space::model()->findByAttributes(array(
                'guid' => $this->space
            ));
            if ($space == null) {
                $this->addError($spaceGuid, Yii::t('ForumBlogModule.forms_BasicSettingsForm', "Invalid space"));
            }
        }
    }
}