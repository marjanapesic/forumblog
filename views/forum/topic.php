
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">
                    <strong><?php echo $topic->title ?></strong>  - 
                    <!-- show space name -->
                    <?php if ( $topic->space != null ): ?>
                        <a href="<?php echo $topic->space->getUrl(); ?>"><small><span class="time"><?php echo CHtml::encode($topic->space->name); ?></span></small></a>
                    <?php endif; ?>                  
                </div>
                
                <div class="panel-body">
                
                    <hr>
                
                    <ul class="media-list">
                        <?php foreach ($posts as $post) {?>
                            
                            <div class="panel panel-default post" id="post-<?php echo $post->id; ?>">
                                <div class="panel-body">
                                    <?php $this->beginContent('application.modules.forumblog.views.forum_layout', array('object' => $post)); ?>
                                    <span id="post-content-<?php echo $post->id; ?>" style="overflow: hidden; margin-bottom: 5px;">
                                        <?php print HHtml::enrichText($post->message); ?>
                                    </span>
                                    <?php $this->endContent(); ?>
                                </div>
                            </div>
                           
                        <?php }?>
                    </ul>
                 </div>
          </div>
               
        </div>
    </div>

</div>
