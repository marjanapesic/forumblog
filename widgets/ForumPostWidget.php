<?php

/**
 * This widget is used to show a post
 *
 * @package humhub.modules.forumblog.widgets
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
     * Indicates the post was just edited
     *
     * @var boolean
     */
    public $justEdited = false;

    /**
     * Executes the widget.
     */
    public function run()
    {

        $this->render('forumPost', array(
            'post' => $this->post,
            'justEdited' => $this->justEdited
        ));
    }

}?>