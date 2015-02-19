<?php

/**
 * This widget is used to show a topic
 *
 * @since 0.5
 */
class ForumTopicWidget extends HWidget
{

    /**
     * The topic object
     *
     * @var ForumTopic
     */
    public $topic;


    public function run()
    {
        $this->render('forumTopic', array(
            'topic' => $this->topic,
        ));
    }
} ?>