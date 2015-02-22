<div  id="newForumPost">
    <div class="panel-body">
    
        <div class="media">

            <!-- end: show wall entry options -->
        
            <a href="<?php echo $user->getProfileUrl(); ?>" class="pull-left">
                <img class="media-object img-rounded user-image" alt="40x40" data-src="holder.js/40x40" style="width: 40px; height: 40px;"
                     src="<?php  echo $user->getProfileImage()->getUrl(); ?>"
                     width="40" height="40"/>
            </a>
        
            <div class="media-body">
                <!-- show username with link and creation time-->
                <h4 class="media-heading"><a
                        href="<?php echo $user->getProfileUrl(); ?>"><?php echo CHtml::encode($user->displayName); ?></a>
                </h4>
                <h5><?php echo CHtml::encode($user->profile->title); ?></h5>
        
            </div>
        
            <!-- show content -->
            <div class="content" id="wall_content_newForumPost" >
                 <?php 
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'new-forum-post-form',
                    'enableAjaxValidation' => false,
                    'action' => Yii::app()->createUrl('//forum/forum/createPost')
                ));?>
                <?php echo $form->hiddenField($post, 'forum_topic_id');?>
                <div class="form-group" style="padding-top:15px;">
                    <?php echo $form->textArea($post, 'message', array('class' => 'form-control', 'id' => 'pageContentNewPost', 'rows' => '10', 'placeholder' => Yii::t('ForumModule.base', 'Content')));?> 
                    <?php $this->widget('application.modules.forum.widgets.MarkdownWidget', array(
                            'form' => $form,
                            'id' => "NewPost"
                          ));
                    
                          echo CHtml::submitButton(Yii::t('ForumModule.base', 'Save'), array('class' => 'btn btn-primary'));
                     ?>
                </div>
                <?php $this->endWidget();?>   
            </div>

        </div>

    </div>
</div>