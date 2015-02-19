<?php

/**
 * This is the model class for table "forum_like".
 *
 * The followings are the available columns in table 'forum_like':
 * @property integer $id
 * @property integer $object_id
 * @property string $object_model
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @package humhub.modules.forum.models
 * @since 0.10
 */
class ForumLike extends HActiveRecordContentAddon
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ForumComment the static model class
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
        return 'forum_like';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('created_by, updated_by', 'numerical', 'integerOnly' => true),
            array('created_at, updated_at', 'safe'),
        );
    }

    public function relations()
    {
        return array(
            'user' => array(static::BELONGS_TO, 'User', 'created_by')
        );
    }

    public function getUser() {
        return User::model()->findByPk($this->created_by);
    }
    
    public static function GetLikes($objectModel, $objectId) {
        $cacheId = "likes_" . $objectModel . "_" . $objectId;
        $cacheValue = Yii::app()->cache->get($cacheId);
    
        if ($cacheValue === false) {
            $newCacheValue = ForumLike::model()->findAllByAttributes(array('object_model' => $objectModel, 'object_id' => $objectId));
            Yii::app()->cache->set($cacheId, $newCacheValue, HSetting::Get('expireTime', 'cache'));
            return $newCacheValue;
        } else {
            return $cacheValue;
        }
    }
}
