<?php
/**
 * This view represents the basic layout of a forum entry.
 *
 * @property HActiveRecordContent $object the object which this forum entry entry belongs to.
 *
 * @package humhub.modules.forumblog
 * @since 0.5
 */
?>
<div class="media">

    <!-- start: show wall entry options -->
    <ul class="nav nav-pills preferences">
        <li class="dropdown ">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-angle-down"></i></a>
            <ul class="dropdown-menu pull-right">
                <?php $this->widget('application.modules.forumblog.widgets.ForumTopicEntryControls', array('object' => $object)); ?>
            </ul>
        </li>
    </ul>
    <!-- end: show wall entry options -->

    <a href="<?php echo $object->content->user->getProfileUrl(); ?>" class="pull-left">
        <img class="media-object img-rounded user-image" alt="40x40" data-src="holder.js/40x40" style="width: 40px; height: 40px;"
             src="<?php echo $object->content->user->getProfileImage()->getUrl(); ?>"
             width="40" height="40"/>
    </a>

    <div class="media-body">
        <!-- show username with link and creation time-->
        <h4 class="media-heading"><a
                href="<?php echo $object->content->user->getProfileUrl(); ?>"><?php echo CHtml::encode($object->content->user->displayName); ?></a>
            <small><?php echo HHtml::timeago($object->content->created_at); ?>
                
                <?php if ($object->content->created_at != $object->content->updated_at): ?>
                    (<?php echo Yii::t('WallModule.views_wallLayout', 'Updated :timeago', array (':timeago'=>HHtml::timeago($object->content->updated_at))); ?>)
                <?php endif; ?>

                <!-- show labels -->
                <?php //$this->widget('application.modules_core.wall.widgets.WallEntryLabelWidget', array('object' => $object)); ?>

            </small>
        </h4>
        <h5><?php echo CHtml::encode($object->content->user->profile->title); ?></h5>

    </div>
    <hr/>

    <!-- show content -->
    <div class="content" id="wall_content_<?php echo $object->getUniqueId(); ?>">
        <?php echo $content; ?>
    </div>

    <!-- show controls -->
    <?php $this->widget('application.modules_core.wall.widgets.WallEntryAddonWidget', array('object' => $object)); ?>
</div>


