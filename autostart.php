<?php

Yii::app()->moduleManager->register(array(
    'id' => 'forumblog',
    'class' => 'application.modules.forumblog.ForumBlogModule',
    'import' => array(
        'application.modules.forumblog.*',
        'application.modules.forumblog.models.*',
        'application.modules.forumblog.forms.*',
        'application.modules.forumblog.widgets.*',
    ),
    // Events to Catch 
    'events' => array(
        array('class' => 'TopMenuWidget', 'event' => 'onInit', 'callback' => array('ForumBlogModule', 'onTopMenuInit')),
        array('class' => 'ForumTopicEntryControls', 'event' => 'onInit', 'callback' => array('ForumBlogModule', 'onForumTopicEntryControlsInit')),
    ),
));
?>
