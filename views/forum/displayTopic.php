<div class="container">

	<div class="row">
		<div class="col-md-12">
			<div class="s2-streamContent">

				<div class="panel">
					<h4 style="padding:10px;"><strong><?php echo $topic->title ?></strong></h4>
               

    				<div class="wall-entry">
                            <?php foreach ($posts as $post) {  
                                
                                echo $this->renderPartial('/forum/post', array(
                                    'post' => $post
                                ));        
                            }?>
                          
                     </div>
                   
                     <div class="wall-entry">
                     <?php
                     echo $this->renderPartial('/forum/postNew', array(
                         'post' => $model,
                         'user' => $user,
                     ));
                       ?>
                     </div>
                 </div>
			</div>

		</div>
	</div>

</div>