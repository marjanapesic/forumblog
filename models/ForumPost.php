<?php

/**
 * This is the model class for table "forum_post".
 *
 * The followings are the available columns in table 'forum_post':
 * @property integer $id
 * @property string $message
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @package humhub.modules.forumblog.models
 * @since 0.5
 */
class ForumPost extends HActiveRecordContent
{
    public $autoAddToWall = false;
    public $editRoute = '//forumblog/forum/editPost';
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Post the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'forum_post';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('message', 'required'),
            array('created_by, updated_by', 'numerical', 'integerOnly' => true),
            array('message, created_at, updated_at', 'safe'),
        );
    }
    
    public function relations()
    {
        return array(
            'topic' => array(self::BELONGS_TO, 'ForumTopic', 'forum_topic_id'),
            'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
            'updatedBy' => array(self::BELONGS_TO, 'User', 'updated_by'),
        );
    }
    
    
    public function getContentTitle()
    {
        return Yii::app()->getController()->widget('application.modules_core.post.widgets.PostWidget', array('post' => $this), true);
        /*return Yii::t('ForumBlogModule.models_ForumPost', 'Forum Post') . " \"" . Helpers::truncateText($this->message, 60) . "\" ".
                Yii::t('ForumBlogModule.models_ForumPost', 'on topic')." ".$this->topic->title;*/
    }
   

}
