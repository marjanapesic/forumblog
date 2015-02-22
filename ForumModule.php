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
        
        Yii::setPathOfAlias('cebe',Yii::getPathOfAlias('forum.vendors.cebe'));
        
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
                'url' => Yii::app()->createUrl('//forum/forum'),
                'sortOrder' => 500
            ));
                       
        }
    }

}
?>