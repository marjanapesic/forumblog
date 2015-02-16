<?php

class ForumModule extends HWebModule
{

    private $assetsUrl;

    public function getAssetsUrl()
    {
        if ($this->assetsUrl === null)
            $this->assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('forum.assets'));
        return $this->assetsUrl;
    }

    public function init()
    {
        $this->setImport(array('forum.components.*'));
        
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/inline/CodeTrait.php');
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/inline/EmphStrongTrait.php');
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/inline/LinkTrait.php');
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/inline/StrikeoutTrait.php');
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/inline/UrlLinkTrait.php');
        
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/block/CodeTrait.php');
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/block/FencedCodeTrait.php');
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/block/HeadlineTrait.php');
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/block/HtmlTrait.php');
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/block/ListTrait.php');
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/block/QuoteTrait.php');
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/block/RuleTrait.php');
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/block/TableTrait.php');
        
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/Parser.php');
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/Markdown.php');
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/MarkdownExtra.php');
        require_once(dirname(__FILE__) . '/vendors/cebe/markdown/GithubMarkdown.php');
        
        return parent::init();
    }

    /**
     * On build of the top menu widget, add the forum and blog if module is enabled.
     *
     * @param type $event            
     */
    public static function onTopMenuInit($event)
    {
        if (Yii::app()->moduleManager->isEnabled('forum')) {
           
            $event->sender->addItem(array(
                'label' => Yii::t('ForumModule.base', 'Forum'),
                'id' => 'forum',
                'icon' => '<i class="fa fa-bars"></i>',
                'url' => Yii::app()->createUrl('//forum/index'),
                'sortOrder' => 500
            ));
            
           /* $event->sender->addItem(array(
                'label' => Yii::t('ForumBlogModule.base', 'Blog'),
                'id' => 'forum',
                'icon' => '<i class="fa fa-files-o"></i>',
                'url' => Yii::app()->createUrl('//forumblog/blog'),
                'sortOrder' => 501,
            ));*/
            
        }
    }

    public static function onForumTopicEntryControlsInit($event)
    {
        $event->sender->addWidget('application.modules.forum.widgets.DeleteLinkWidget', array(
            'object' => $event->sender->object
        )
        );
        
        $event->sender->addWidget('application.modules.forum.widgets.EditLinkWidget', array(
            'object' => $event->sender->object
        )
        );
    }

 
}
?>
