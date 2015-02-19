<?php

/**
 * Forum Controller
 *
 * @package humhub.modules.forum.controllers
 * @author Marjana Pesic
 */
class ForumController extends Controller
{

    /**
     *
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl'
        ); // perform access control for CRUD operations
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
             array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }    
    
    //crete topic and first post
    public function actionCreate()
    {
        $model = new CreateForumTopicForm();
    
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'forum-topic-create-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    
        if (isset($_POST['CreateForumTopicForm'])) {
  
            $model->attributes = $_POST['CreateForumTopicForm'];
    
            if ($model->validate()) {
    
                $topic = new ForumTopic();
                $topic->title = $model->title;
                if($model->space){
                    $space = Space::model()->findByAttributes(array('guid' => $model->space));
                    $topic->space_id = $space->id;
                }
                
                if ($topic->space_id == null){
                    $contentContainer = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
                    $topic->content->visibility=1;
                }
                else
                    $contentContainer = Space::model()->findByAttributes(array('id' => $topic->space_id));
                
                $topic->content->container = $contentContainer;
                
                $topic->save();
    
                $forumPost = new ForumPost();
                $forumPost->forum_topic_id = $topic->id;
                $forumPost->message = $model->message;
                $forumPost->isFirstPost = 1;
                if ($topic->space_id == null){   
                    $forumPost->content->visibility=1;
                }
                $forumPost->content->container = $contentContainer;
    
    
                $forumPost->save();
    
                File::attachPrecreated($forumPost, Yii::app()->request->getParam('fileUploaderHiddenGuidField'));
    
                return $this->htmlRedirect($this->createUrl('//forum/index'));
    
            }
        }
    
        $this->render('edit', array('model' => $model));
    }
    
    
    public function actionDisplayTopic(){
        
        $guid = Yii::app()->request->getQuery('guid');
        
        // Try Load the space
        $forumTopic = ForumTopic::model()->findByAttributes(array('guid' => $guid));
        if ($forumTopic == null)
            throw new CHttpException(404, Yii::t('Forum.controller_ForumController', 'Forum topic not found!'));
        
        //$model = new ForumPost();
        
        /*if (isset($_POST['ForumPost'])) {
            $_POST['ForumPost'] = Yii::app()->input->stripClean($_POST['ForumPost']);
            $model->attributes = $_POST['ForumPost'];
         
            if ($forumTopic->space_id == null){
                $contentContainer = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
                $model->content->visibility=1;
            }
            else
                $contentContainer = Space::model()->findByAttributes(array('id' => $forumTopic->space_id));
            
            $model->content->container = $contentContainer;
            
            if ($model->validate()) {
                $model->forum_topic_id = $forumTopic->id;
                $model->save();
            }
        }*/
        
        $posts = ForumPost::model()->findAllByAttributes(array('forum_topic_id'=> $forumTopic->id));
        foreach($posts as $post){
            $post->message = $this->parseMarkdown($post->message);   
        }
        
        $model = new ForumPost();
        $model->forum_topic_id = $forumTopic->id;
        $user = User::model()->findByPk(Yii::app()->user->id);
        $this->render('displayTopic', array('topic' => $forumTopic, 'posts' => $posts, 'model' => $model, 'user'=> $user));
    } 
    
    public function actionCreatePost() {
        
        $this->forcePostRequest();
        
        $model = new ForumPost();
        
        if (isset($_POST['ForumPost'])) {
            $_POST['ForumPost'] = Yii::app()->input->stripClean($_POST['ForumPost']);
            $model->attributes = $_POST['ForumPost'];
            $model->forum_topic_id = $_POST['ForumPost']['forum_topic_id'];
            
            $forumTopic = ForumTopic::model()->findByPk($model->forum_topic_id);
          
            if ($forumTopic->space_id == null){
                $contentContainer = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
                $model->content->visibility=1;
            }
            else
                $contentContainer = Space::model()->findByAttributes(array('id' => $forumTopic->space_id));
        
            $model->content->container = $contentContainer;
        
            if ($model->validate()) {
                //$model->forum_topic_id = $forumTopic->id;
                $model->save();
            }
        }
        $forumTopic = ForumTopic::model()->findByPk($model->forum_topic_id);
         return $this->htmlRedirect($this->createUrl('//forum/forum/displayTopic', array('guid' => $forumTopic->guid)));
    }
    
    public function actionPostEdit(){
    
        $id = Yii::app()->request->getParam('id');
         
        $model = ForumPost::model()->findByPk($id);
    
        if ($model->content->canWrite()) {
    
            if (isset($_POST['ForumPost'])) {
                $_POST['ForumPost'] = Yii::app()->input->stripClean($_POST['ForumPost']);
                $model->attributes = $_POST['ForumPost'];
                if ($model->validate()) {
                    $model->save();
    
                    // Reload record to get populated updated_at field
                    $model = ForumPost::model()->findByPk($id);
                    $model->message = $this->parseMarkdown($model->message);
                    // Return the new post
                    /*$output = $this->widget('application.modules.forum.widgets.ForumPostWidget', array(
                        'post' => $model,
                 
                    ), true);*/
                    $output = $this->renderPartial('/forum/post', array('post'=> $model));
                    Yii::app()->clientScript->render($output);
                    echo $output;
                    return;
                }
            }
    
            $output = $this->renderPartial('/forum/postEdit', array('post'=> $model), false, true);
        } else {
            throw new CHttpException(403, Yii::t('Forum.controllers_ForumController', 'Access denied!'));
        }
    }
    
    
    public function actionTopicEdit(){
    
        //$this->forcePostRequest();

        $id = Yii::app()->request->getParam('id');
        
        
        $model = ForumTopic::model()->findByPk($id);
    
        if ($model->content->canWrite()) {
    
            if (Yii::app()->request->isPostRequest) {
                $title = Yii::app()->input->stripClean(Yii::app()->request->getParam('title'));

                $model->title = $title;
          
                if ($model->validate()) {
                    $model->save();
    
                    // Reload record to get populated updated_at field
                    $model = ForumTopic::model()->findByPk($id);
                    $output = $this->renderPartial('/forum/topicEntry', array('topic' => $model, 'editable'=>false));
                    Yii::app()->clientScript->render($output);
                    echo $output;
                    return;
                }
            }
    
            $this->renderPartial('/forum/topicEntry', array('topic' => $model, 'editable'=>true), false, true);
        } else {
            throw new CHttpException(403, Yii::t('Forum.controllers_ForumController', 'Access denied!'));
        }
    }
    
    public function actionDelete() {
        
         $this->forcePostRequest();

        // Json Array
        $json = array();
        $json['success'] = false;

        $model = Yii::app()->request->getParam('model', "");
        $id = (int) Yii::app()->request->getParam('id');

        $content = Content::get($model, $id);

        if ($content->content->canDelete()) {

            if ($content->delete()) {
                if(($model=="ForumPost" && $content->isFirstPost))
                    return $this->htmlRedirect($this->createUrl('//forum/index'));
                $json['success'] = true;
            }            

        }

        echo CJSON::encode($json);
        Yii::app()->end();
    }
    
    public function actionDeleteTopic()
    {
        $this->forcePostRequest();
        
        // Json Array
        $json = array();
        $json['success'] = false;
        
        $id = (int) Yii::app()->request->getParam('id');
        
        $topic = ForumTopic::findByPk($id);
        
        if ($topic->content->canDelete()) {
        
            if ($topic->delete()) {
                $json['success'] = true;
            }
        
        }
        
        echo CJSON::encode($json);
        Yii::app()->end();
    }
    
    
    public function actionPreview()
    {
        $this->forcePostRequest();
    
        $content = Yii::app()->request->getParam('markdown');
        $markdown = $this->parseMarkdown($content);
    
        $this->renderPartial('preview', array('content' => $markdown));
    }

    private function parseMarkdown($md)
    {
        $parser = new ForumMarkdown();
        $html = $parser->parse($md);
    
        $purifier = new CHtmlPurifier();
        return $purifier->purify($html);
    }    
    
}
?>