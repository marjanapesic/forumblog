<?php

/**
 *
 * @package humhub.modules.forumblog.widgets
 * @since 0.5
 */
class PostEntryAddonWidget extends HWidget {

    /**
     * Object derived from HActiveRecordContent
     *
     * @var type
     */
    public $object = null;

    public function init(){
        
        
        $modelId = $this->object->content->object_id;
        $modelName = $this->object->content->object_model;
        
        $commentCount = ForumComment::GetCommentCount($modelName, $modelId);
        
        echo "<div class=\"wall-entry-controls\">";
        

        
        $this->getController()->widget('application.modules.forum.widgets.LikeLinkWidget', array(
            'object' => $this->object
        )
        );
        
        echo "&nbsp;&middot;&nbsp;";
        
        
        $this->render('commentLink', array(
            'id' => $this->object->content->object_model . "_" . $this->object->content->object_id,
            'total' => $commentCount,
            'objectId' => $this->object->content->object_id,
        ));
       
      
        echo "</div>";
       
       // Indicates that the number of comments was limited
       $isLimited = false;
       
       // Count all Comments
      
       $comments = ForumComment::GetComments($modelName, $modelId);
      
       
       $this->render('comments', array(
           'object' => $this->object,
           'comments' => $comments,
           'modelName' => 'ForumPost',
           'modelId' => $modelId,
           'id' => 'ForumPost' . "_" . $modelId,
           'isLimited' => $isLimited,
           'total' => $commentCount
       )
       );


    }
    
}

?>