<?php

/**
 * This widget is used to show a post
 *
 * @since 0.5
 */
class ForumPostWidget extends HWidget
{

    /**
     * The post object
     *
     * @var Post
     */
    public $post;


    /**
     * Executes the widget.
     */
    
    public function init() {
        /*Yii::app()->clientScript->setJavascriptVariable(
        "forumLikeUrl", Yii::app()->createUrl('//forum/like/like', array('className' => '-className-', 'id' => '-id-'))
        );
        Yii::app()->clientScript->setJavascriptVariable(
        "forumUnlikeUrl", Yii::app()->createUrl('//forum/like/unlike', array('className' => '-className-', 'id' => '-id-'))
        );
        Yii::app()->clientScript->setJavascriptVariable(
        "forumShowLikesUrl", Yii::app()->createUrl('//forum/like/showLikes', array('className' => '-className-', 'id' => '-id-'))
        );
        
        
        $assetPrefix = Yii::app()->assetManager->publish(dirname(__FILE__) . '/../resources/', true, 0, defined('YII_DEBUG'));
        
        Yii::app()->clientScript->registerScriptFile($assetPrefix . '/forumLike.js');*/
    }
    public function run()
    {
        $this->render('forumPost', array(
            'post' => $this->post
        ));
    }
} ?>