<?php

/**
 * @package humhub.modules.forum.forms
 * @since 0.5
 */
class CreateForumTopicForm extends CFormModel
{

    public $title;

    public $message;

    
    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array(
                'title, message',
                'required'
            ),
            array(
                'title',
                'length',
                'max' => 255
            )
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'title' => Yii::t('ForumBlogModule.forms_CreateForumTopicForm', 'Forum topic title'),
            'message' => Yii::t('ForumBlogModule.forms_CreateForumTopicForm', 'Message'),
            'space' => Yii::t('ForumBlogModule.forms_CreateForumTopicForm', 'Space')
        );
    }
}