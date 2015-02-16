
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <?php echo Yii::t('ForumModule.views_index_index', 'Forum'); ?>
                    <div class='pull-right'>
                    <?php echo HHtml::link(Yii::t('ForumModule.views_index_index', 'New topic'), $this->createUrl('//forum/create/create')) ?>
                     <?php //echo HHtml::link(Yii::t('ForumModule.views_index_index', 'New topic'), $this->createUrl('//forum/create'), array('data-toggle'=> 'modal', 'data-target' =>'#globalModal'))?>
                    </div>
                    
                </div>
                
                
                <div class="panel-body">
                
                    <hr>
                
                    <ul class="media-list">
                        <?php foreach ($userTopics as $topic) {?>
                            <div class="media">
                                <img class="media-object img-rounded pull-left"
                                     data-src="holder.js/32x32" alt="32x32"
                                     style="width: 32px; height: 32px;"
                                     src="<?php echo $topic->createdBy->getProfileImage()->getUrl(); ?>">
            
                                <!-- show content -->
                                <div class="media-body">
                                    <a href="<?php echo $topic->getUrl()?>"><strong><?php echo $topic->title; ?>
                                    </strong></a>
                                    <br/>
                                    <span class="time"><?php echo Yii::t('ForumModule.views_index_index', 'started by')?> </span> <?php echo " ".$topic->createdBy->username;?> 
                            
                                    <span class="time" ><?php echo Yii::t('ForumModule.views_index_index', 'last reply by')?> </span> <?php echo " ".$topic->getLastEntry()->createdBy->username;?> 
  
                                    <span class="time"
                                              title="<?php echo $topic->getLastEntry()->created_at;; ?>"><?php echo $topic->getLastEntry()->created_at; ?></span>
                                   
                                </div>
                                
                             
                            </div>
                            <hr/>
                        <?php }?>
                    </ul>
                
                    <div class="pagination-container">
                            <?php
                            $this->widget('CLinkPager', array(
                                'maxButtonCount' => 5,
                                'pages' => $pages,
                                'maxButtonCount' => 5,
                                'nextPageLabel' => '<i class="fa fa-step-forward"></i>',
                                'prevPageLabel' => '<i class="fa fa-step-backward"></i>',
                                'firstPageLabel' => '<i class="fa fa-fast-backward"></i>',
                                'lastPageLabel' => '<i class="fa fa-fast-forward"></i>',
                                'header' => '',
                                'htmlOptions' => array(
                                    'class' => 'pagination'
                                ),
                                'id' => 'link_pager'
                            ));
                            ?>
                     </div>
                </div>
             </div>
               
        </div>
    </div>

</div>
