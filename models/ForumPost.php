<?php

/**
 * This is the model class for table "forum_post".
 *
 * The followings are the available columns in table 'forum_post':
 * @property integer $id
 * @property string $message
 * @property int $isFirstPost
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @package humhub.modules.forum.models
 * @since 0.5
 */
class ForumPost extends HActiveRecord
{

    public $editRoute = '//forum/forum/postEdit';
    
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
    

    public function afterDelete(){
        if((int)$this->isFirstPost){
            $topic = ForumTopic::model()->findByPk($this->forum_topic_id);
            if($topic)
                $topic->delete();
        }
        return parent::afterDelete();
    }
    
    
    public function canWrite($userId = "")
    {
        if ($userId == "")
            $userId = Yii::app()->user->id;
    
        if ($this->created_by == $userId)
            return true;
    
        return false;
    }
    
    public function canDelete($userId = "")
    {
    
        if ($userId == "")
            $userId = Yii::app()->user->id;
    
        if ($this->created_by == $userId)
            return true;
    
        if (Yii::app()->user->isAdmin()) {
            return true;
        }
    
        return false;
    }
}
