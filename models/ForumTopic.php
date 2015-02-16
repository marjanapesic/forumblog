<?php

/**
 * This is the model class for table "forum_topic".
 *
 * The followings are the available columns in table 'forum_topic':
 * @property integer $id
 * @property string $title
 * @property integer $space_id
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 *
 * @package humhub.modules.forumblog.models
 * @since 0.5
 */
class ForumTopic extends HActiveRecord
{
    
    public $addToActivity = false;

    public function behaviors()
    {
        return array(
            'HGuidBehavior' => array(
                'class' => 'application.behaviors.HGuidBehavior',
            ),
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Space the static model class
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
        return 'forum_topic';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('title', 'required'),
            array('space_id, created_by, updated_by', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 255),
            array('created_at, updated_at', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'space' => array(self::BELONGS_TO, 'Space', 'space_id'),
            'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
            'updatedBy' => array(self::BELONGS_TO, 'User', 'updated_by'),
            'wall' => array(self::BELONGS_TO, 'Wall', 'wall_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'space_id' => Yii::t('ForumBlogModule.models_ForumTopic', 'Space'),
            'title' => Yii::t('SpaceModule.models_Space', 'Title'),
            'created_at' => Yii::t('SpaceModule.models_Space', 'Created At'),
            'created_by' => Yii::t('SpaceModule.models_Space', 'Created By'),
            'updated_at' => Yii::t('SpaceModule.models_Space', 'Updated At'),
            'updated_by' => Yii::t('SpaceModule.models_Space', 'Updated by'),
        );
    }
    

   /* public function afterSave() {
        // Create new wall record for this user
        $wall = new Wall();
       
        $wall->type =  ($this->space_id) ? Wall::TYPE_SPACE : Wall::TYPE_USER;
        $wall->object_model = 'ForumTopic';
        $wall->object_id = $this->id;
        $wall->save();
    
        $this->wall_id = $wall->id;
        $this->wall = $wall;
        ForumTopic::model()->updateByPk($this->id, array('wall_id' => $wall->id));
    }*/
    
    
    public function getLastEntry() {
    
        $criteria = new CDbCriteria;
        $criteria->limit = 1;
        $criteria->order = "created_at DESC";
        $criteria->condition = "forum_topic_id=" . $this->id;

        return ForumPost::model()->find($criteria);
    }

    public function getUrl($parameters = array())
    {
        return $this->createUrl('//forum/forum/displayTopic', $parameters);
    }
    
    public function createUrl($route, $params = array(), $ampersand = '&')
    {
        if (!isset($params['guid'])) {
            $params['guid'] = $this->guid;
        }
    
        if (Yii::app()->getController() !== null) {
            return Yii::app()->getController()->createUrl($route, $params, $ampersand);
        } else {
            return Yii::app()->createUrl($route, $params, $ampersand);
        }
    }
    
    
    public function canWrite($userId = "")
    {

        if($this->space_id){
            $space = Space::model()->findByPk($this->space_id);
            
            if ($userId == "")
                $userId = Yii::app()->user->id;
            return $space->isMemeber($userId);
        }
        
        return true;
    }
    
    public function canRead($userId = "")
    {
    
        if($this->space_id){
            $space = Space::model()->findByPk($this->space_id);
    
            if ($userId == "")
                $userId = Yii::app()->user->id;
            return $space->isMemeber($userId);
        }
    
        return true;
    }
    
    
    public function canAdminister(){
        
        if($this->created_by){
            return $this->created_by == Yii::app()->user->id;
        }
        
        return true;
    }
    
    public function beforeDelete() {
        
        $posts = ForumPost::model()->findAllByAttributes(array('forum_topic_id' => $this->id));
        foreach($posts as $post){
            $post->delete();
        }
        return parent::beforeDelete();
    }
    
    
   /* public function  createPost() {
        
        $post = new ForumPost();
        $rev->user_id = Yii::app()->user->id;
        $rev->revision = time();
        
        $lastRevision = WikiPageRevision::model()->findByAttributes(array('is_latest' => 1, 'wiki_page_id' => $this->id));
        if ($lastRevision !== null) {
            $rev->content = $lastRevision->content;
        }
        
        if (!$this->isNewRecord) {
            $rev->wiki_page_id = $this->id;
        }
        
        
        return $rev;
    }*/
}