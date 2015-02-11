<?php

class ForumBlogModule extends HWebModule
{

    private $assetsUrl;

    public function getAssetsUrl()
    {
        if ($this->assetsUrl === null)
            $this->assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('forumblog.assets'));
        return $this->assetsUrl;
    }

    public function init()
    {}

    /**
     * On build of the top menu widget, add the forum and blog if module is enabled.
     *
     * @param type $event            
     */
    public static function onTopMenuInit($event)
    {
        if (Yii::app()->moduleManager->isEnabled('forumblog')) {
           
            $event->sender->addItem(array(
                'label' => Yii::t('ForumBlogModule.base', 'Forum'),
                'id' => 'forum',
                'icon' => '<i class="fa fa-bars"></i>',
                'url' => Yii::app()->createUrl('//forumblog/forum'),
                'sortOrder' => 500
            ));
            
            $event->sender->addItem(array(
                'label' => Yii::t('ForumBlogModule.base', 'Blog'),
                'id' => 'forum',
                'icon' => '<i class="fa fa-files-o"></i>',
                'url' => Yii::app()->createUrl('//forumblog/blog'),
                'sortOrder' => 501,
            ));
            
        }
    }

    public static function onForumTopicEntryControlsInit($event)
    {
        $event->sender->addWidget('application.modules.forumblog.widgets.DeleteLinkWidget', array(
            'object' => $event->sender->object
        )
        );
        
        $event->sender->addWidget('application.modules.forumblog.widgets.EditLinkWidget', array(
            'object' => $event->sender->object
        )
        );
    }

 
}
?>
