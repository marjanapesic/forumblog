<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">

				<div class="panel-heading">
                    <?php echo Yii::t('ForumModule.views_index_index', 'Forum'); ?>
                    <div class='pull-right'>
                        <?php echo HHtml::link(Yii::t('ForumModule.views_forum_index', 'New topic'), $this->createUrl('//forum/forum/create'))?>
                    </div>

				</div>


				<div class="panel-body">
					<hr>
					<?php if(count($userTopics) ==0) echo Yii::t('ForumModule.views_forum_index', "There are no forum topics yet."); ?>
		            <?php foreach ($userTopics as $topic) {?>
                            <?php /*$topicModel = new ForumTopic();
                            $topicModel->attributes = $topic;
                            $topicModel->id=$topic['id'];*/ ?>
                            <?php $this->renderPartial('/forum/topic', array('topic' => $topic, 'editable'=>false));?>
                            
                        <?php }?>
               
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