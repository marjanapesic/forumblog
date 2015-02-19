<?php

/**
 *
 * @package humhub.modules.forum.widgets
 * @since 0.10
 */
class LikeLinkWidget extends HWidget {

    /**
     * Object derived from HActiveRecordContent
     *
     * @var type
     */
    public $object = null;

    public function init(){
        
        Yii::app()->clientScript->setJavascriptVariable(
            "forumLikeUrl", Yii::app()->createUrl('//forum/like/like', array('className' => '-className-', 'id' => '-id-'))
        );
        Yii::app()->clientScript->setJavascriptVariable(
            "forumUnlikeUrl", Yii::app()->createUrl('//forum/like/unlike', array('className' => '-className-', 'id' => '-id-'))
        );
        Yii::app()->clientScript->setJavascriptVariable(
            "forumShowLikesUrl", Yii::app()->createUrl('//forum/like/showLikes', array('className' => '-className-', 'id' => '-id-'))
        );
        
        
        $likes = ForumLike::GetLikes(get_class($this->object), $this->object->id);
        Yii::app()->clientScript->registerScript(
        "updateForumLikeCounter" . $this->object->getUniqueId()
        , "updateForumLikeCounters('" . get_class($this->object) . "', '" . $this->object->id . "', " . count($likes) . ");"
            , CClientScript::POS_READY
        );
        
        Yii::app()->clientScript->registerScriptFile(
                Yii::app()->assetManager->publish(
                        Yii::getPathOfAlias('application.modules.forum.resources') . '/forumLike.js'
                ), CClientScript::POS_BEGIN
        );


        // Execute Like Javascript Init
        Yii::app()->clientScript->registerScript('initForumLike', 'initForumLike();', CClientScript::POS_READY);
        
        $currentUserLiked = false;
        
        $likes = ForumLike::GetLikes(get_class($this->object), $this->object->id);
        foreach ($likes as $like) {
            if ($like->getUser()->id == Yii::app()->user->id) {
                $currentUserLiked = true;
            }
        }
        
        $this->render('likeLink', array(
            'likes' => $likes,
            'currentUserLiked' => $currentUserLiked,
            'id' => $this->object->getUniqueId()
        ));
    }
}