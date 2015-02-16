<?php

Yii::app()->moduleManager->register(array(
    'id' => 'forum',
    'class' => 'application.modules.forum.ForumModule',
    'import' => array(
        'application.modules.forum.*',
        'application.modules.forum.models.*',
        'application.modules.forum.forms.*',
        'application.modules.forum.widgets.*',
    ),
    // Events to Catch 
    'events' => array(
        array('class' => 'TopMenuWidget', 'event' => 'onInit', 'callback' => array('ForumModule', 'onTopMenuInit')),
        //array('class' => 'ForumTopicEntryControls', 'event' => 'onInit', 'callback' => array('ForumBlogModule', 'onForumTopicEntryControlsInit')),
    ),
));
?>
