<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="s2-streamContent">

				<div class="panel">
					<strong><?php echo $topic->title ?></strong>
					
					<!-- show space name -->
                    <?php if ( $topic->space != null ): ?>
                       - <a href="<?php echo $topic->space->getUrl(); ?>"><small><span class="time"><?php echo CHtml::encode($topic->space->name); ?></span></small></a>
                    <?php endif; ?>                  
                </div>

				<div class="wall-entry">
                        <?php foreach ($posts as $post) {  
                            
                            echo $this->renderPartial('/forum/post', array(
                                'post' => $post,
                                //'editable' => false
                            ));    
                        }?>
                      
                 </div>
                 
                 <div class="wall-entry">
                 <?php
                 echo $this->renderPartial('/forum/postNew', array(
                     'post' => $model,
                     'user' => $user,
                   
                     //'editable' => false
                 ));
                   ?>
                 </div>

			</div>

		</div>
	</div>

</div>