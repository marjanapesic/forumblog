<?php

/**
 * Forum Controller
 *
 * @package humhub.modules.forumblog.controllers
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

    
    public function actionIndex(){
  
        $topicsPerPage = 10;
        
        // Current page
        $page = (int) Yii::app()->request->getParam('page', 1);
     
        $spaces = array();
        $allUserSpaces = SpaceMembership::GetUserSpaces(Yii::app()->user->id);
        foreach($allUserSpaces as $userSpace){
            $spaces[] = $userSpace->id;
        }
        $spaces = implode(",",$spaces);
        
        //needs to be criteria
        $sql = "SELECT forum_topic.*
		FROM forum_topic
		LEFT JOIN forum_post on forum_post.forum_topic_id = forum_topic.id
        WHERE  forum_topic.space_id in (". $spaces.") OR isnull(forum_topic.space_id)";
        
        $userTopicsCount = ForumTopic::model()->count("t.space_id in (". $spaces.") OR isnull(t.space_id)");
        
        $sql .= "ORDER BY forum_topic.updated_at DESC
		LIMIT " . intval(($page - 1) * $topicsPerPage) . "," . intval($topicsPerPage);

        $userTopics = ForumTopic::model()->findAllBySql($sql);

        
        $pages = new CPagination($userTopicsCount);
        $pages->setPageSize($topicsPerPage);
        
        $this->render('index', array(
            'userTopics' => $userTopics,
            'topicCount' => $userTopicsCount,
            'pageSize' => $topicsPerPage,
            'pages' => $pages
        ));
   
    }
    
    public function actionTopic(){
        
        $guid = Yii::app()->request->getQuery('guid');
        
        // Try Load the space
        $forumTopic = ForumTopic::model()->findByAttributes(array('guid' => $guid));
        if ($forumTopic == null)
            throw new CHttpException(404, Yii::t('ForumBlogModule.controller_ForumController', 'Forum topic not found!'));
        
        $posts = ForumPost::model()->findAllByAttributes(array('forum_topic_id'=> $forumTopic->id));
        $this->render('topic', array('topic' => $forumTopic, 'posts' => $posts));
    }
}

?>
