<?php

/**
 * CreateController is responsible for creation of forum topics
 *
 * @package humhub.modules.forumblog.controllers
 * @since 0.5
 */
class CreateController extends Controller
{

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
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

    public function actionIndex()
    {       
        $this->redirect($this->createUrl('create/create'));
    }

    /**
     * Creates a new ForumTopic
     */
  /*  public function actionCreate()
    {

        $model = new CreateForumTopicForm();

        // Ajax Validation
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'forum-topic-create-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['CreateForumTopicForm'])) {

            $model->attributes = $_POST['CreateForumTopicForm'];

            if ($model->validate()) {

                $forumTopic = new ForumTopic();
                $forumTopic->title = $model->title;
                if($model->space){
                    $space = Space::model()->findByAttributes(array('guid' => $model->space));
                    $forumTopic->space_id = $space->id;
                }
                $forumTopic->save();
                
                $forumPost = new ForumPost();
                $forumPost->forum_topic_id = $forumTopic->id;
                $forumPost->message = $model->message;
                if ($forumTopic->space_id == null){
                    $contentContainer = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
                    $forumPost->content->visibility=1;
                }
                else
                    $contentContainer = Space::model()->findByAttributes(array('id' => $forumTopic->space_id));
                
                $forumPost->content->container = $contentContainer;
                

                $forumPost->save();

                // Redirect to the new created Space
                $this->htmlRedirect($this->createUrl('//forum/index'));
            }
        }

        $this->renderPartial('create', array('model' => $model), false, true);
    }*/

    /*
    
    public function actionView()
    {
        $title = Yii::app()->request->getQuery('title');
    
        $page = ForumTopic::model()->findByAttributes(array('title' => $title));
        if ($page !== null) {
    
            $this->render('view', array('page' => $page));
        } else {
            $this->redirect($this->createUrl('edit', array('title' => $title)));
        }
    }*/
}

?>
