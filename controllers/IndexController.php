<?php

class IndexController extends Controller
{

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
        WHERE  forum_topic.space_id in (". $spaces.") OR isnull(forum_topic.space_id) GROUP BY forum_topic.id";
    
        $userTopicsCount = ForumTopic::model()->count("t.space_id in (". $spaces.") OR isnull(t.space_id)");
    
        $sql .= " ORDER BY forum_topic.updated_at DESC
    
		LIMIT " . intval(($page - 1) * $topicsPerPage) . "," . intval($topicsPerPage)." ";
    
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
    
    
    public function actionSearchSpace()
    {
        $keyword = Yii::app()->request->getParam('keyword', ""); // guid of user/workspace
        $page = (int) Yii::app()->request->getParam('page', 1); // current page (pagination)
        $limit = (int) Yii::app()->request->getParam('limit', HSetting::Get('paginationSize')); // current page (pagination)
        $userGuid = Yii::app()->request->getQuery('guid');
        $keyword = Yii::app()->input->stripClean($keyword);
        $hitCount = 0;
    
        if ($userGuid) {
            $user = User::model()->findByAttributes(array(
                'guid' => $userGuid
            ));
        }
    
        if (! isset($user)) {
            print CJSON::encode(array());
            Yii::app()->end();
        }
    
        $query = "model:Space ";
        if (strlen($keyword) > 2) {
    
            // Include Keyword
            if (strpos($keyword, "@") === false) {
                $keyword = str_replace(".", "", $keyword);
                $query .= "AND (title:" . $keyword . "* OR tags:" . $keyword . "*)";
            }
        }
    
        // , $limit, $page
        $hits = new ArrayObject(HSearch::getInstance()->Find($query));
    
        $hitCount = count($hits);
    
        // Limit Hits
        $hits = new LimitIterator($hits->getIterator(), ($page - 1) * $limit, $limit);
    
        $json = array();
        // $json['totalHits'] = $hitCount;
        // $json['limit'] = $limit;
        // $results = array();
        foreach ($hits as $hit) {
            $doc = $hit->getDocument();
            $model = $doc->getField("model")->value;
    
            if ($model == "Space") {
                $workspaceId = $doc->getField('pk')->value;
                $workspace = Space::model()->findByPk($workspaceId);
    
                if ($workspace != null) {
                    $membership = SpaceMembership::model()->findByAttributes(array(
                        'space_id' => $workspace->id,
                        'user_id' => $user->id
                    ));
                    if ($membership == null || $membership->status != SpaceMembership::STATUS_MEMBER) {
                        continue;
                    }
                    $wsInfo = array();
                    $wsInfo['guid'] = $workspace->guid;
                    $wsInfo['title'] = CHtml::encode($workspace->name);
                    $wsInfo['tags'] = CHtml::encode($workspace->tags);
                    $wsInfo['image'] = $workspace->getProfileImage()->getUrl();
                    $wsInfo['link'] = $workspace->getUrl();
                    // $results[] = $wsInfo;
                    $json[] = $wsInfo;
                } else {
                    Yii::log("Could not load workspace with id " . $userId . " from search index!", CLogger::LEVEL_ERROR);
                }
            } else {
                Yii::log("Got no workspace hit from search index!", CLogger::LEVEL_ERROR);
            }
        }
        // $json['results'] = $results;
    
        print CJSON::encode($json);
        Yii::app()->end();
    }
}