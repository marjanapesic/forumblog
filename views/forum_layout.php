        <div class="media">

            <!-- start: show wall entry options -->
            <ul class="nav nav-pills preferences">
                <li class="dropdown ">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-angle-down"></i></a>
                    <ul class="dropdown-menu pull-right">
                        <?php $this->widget('application.modules.forum.widgets.ForumPostEntryControls', array('object' => $post)); ?>
                    </ul>
                </li>
            </ul>
            <!-- end: show wall entry options -->
        
            <a href="<?php echo $post->content->user->getProfileUrl(); ?>" class="pull-left">
                <img class="media-object img-rounded user-image" alt="40x40" data-src="holder.js/40x40" style="width: 40px; height: 40px;"
                     src="<?php echo $post->content->user->getProfileImage()->getUrl(); ?>"
                     width="40" height="40"/>
            </a>
        
            <div class="media-body">
                <!-- show username with link and creation time-->
                <h4 class="media-heading"><a
                        href="<?php echo $post->content->user->getProfileUrl(); ?>"><?php echo CHtml::encode($post->content->user->displayName); ?></a>
                    <small><?php echo HHtml::timeago($post->content->created_at); ?>
                        
                        <?php if ($post->content->created_at != $post->content->updated_at): ?>
                            (<?php echo Yii::t('WallModule.views_wallLayout', 'Updated :timeago', array (':timeago'=>HHtml::timeago($post->content->updated_at))); ?>)
                        <?php endif; ?>
   
                    </small>
                </h4>
                <h5><?php echo CHtml::encode($post->content->user->profile->title); ?></h5>
        
            </div>
            <hr/>
        
            <!-- show content -->
            <div class="content" id="wall_content_<?php echo $post->getUniqueId(); ?>" >
                <?php echo $content; ?>
            </div>
            <!-- show controls -->
            <?php $this->widget('application.modules.forum.widgets.PostEntryAddonWidget', array('object' => $post)); ?>
        </div>


<script type="text/javascript">

    
    $(window).load(function () {


        var postHeight = $('#post-content-<?php echo $post->id; ?>').height();
        var postWidth = $('#post-content-<?php echo $post->id; ?>').outerWidth();
        var parentWidth = $('#post-content-<?php echo $post->id; ?>').parent().outerWidth();

        if (postHeight > 420) {
            $('#post-content-<?php echo $post->id; ?>').css({'display': 'block', 'max-height': '420px'});
            $('#post-content-<?php echo $post->id; ?>').css({'overflow-y': 'scroll'})
        }

        if(postWidth > parentWidth) {
        	 $('#post-content-<?php echo $post->id; ?>').css({'display': 'block', 'max-width': parentWidth+'px'});
        	 $('#post-content-<?php echo $post->id; ?>').css({'overflow-x': 'scroll'})
        }
    });

</script>