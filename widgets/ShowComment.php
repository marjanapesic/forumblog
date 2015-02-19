<?php

/**
 * This widget is used to show a single comment.
 *
 * It will used by the CommentsWidget and the CommentController to show comments.
 *
 * @package humhub.modules_core.comment
 * @since 0.5
 */
class ShowComment extends HWidget
{

    /**
     * @var Comment object to display
     */
    public $comment = null;

    /**
     * Indicates the comment was just edited
     * 
     * @var boolean
     */
    public $justEdited = false;

    /**
     * Executes the widget.
     */
    public function run()
    {

        $user = $this->comment->user;

        $this->comment->message = $this->parseMarkdown($this->comment->message);
    
        $this->render('showComment', array(
            'comment' => $this->comment,
            'user' => $user,
            'justEdited' => $this->justEdited,
                )
        );
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