<div class="modal-dialog modal-dialog-small animated fadeIn">
    <div class="modal-content">
        <?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'forum-topic-create-form',
            'enableAjaxValidation' => false,
        ));
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"
                id="myModalLabel"><?php echo Yii::t('ForumModule.views_create_create', '<strong>Create</strong> new forum topic'); ?></h4>
        </div>
        <div class="modal-body">

            <hr/>
            <br/>


            <div class="form-group">
                <?php echo $form->labelEx($model, 'title'); ?>
                <?php print $form->textField($model, 'title', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'title'); ?>
            </div>

           <div class="form-group">
                <?php echo $form->labelEx($model, 'message'); ?>
                <?php echo $form->textArea($model, 'message', array('class' => 'form-control', 'rows' => '7')); ?>
                <?php echo $form->error($model, 'message'); ?>
            </div>
            
            <?php echo $form->labelEx($model, 'space'); ?>
            <?php echo $form->textField($model, 'space', array('class' => 'form-control', 'id' => 'space_select')); ?>
            <?php
            $this->widget('application.modules_core.space.widgets.SpacePickerWidget', array(
                'spaceSearchUrl' => $this->createUrl('//forum/index/searchSpace', array('keyword' => '-keywordPlaceholder-', 'guid'=>Yii::app()->user->guid)),
                'inputId' => 'space_select',
                'model' => $model,
                'attribute' => 'space',
                'maxSpaces' => 1
            ));
        ?>
        </div>

        <div class="modal-footer">
            <hr/>
            <br/>
            <?php
            echo HHtml::ajaxButton(Yii::t('ForumModule.views_create_create', 'Create'), array('//forum/create/create'), array(
                'type' => 'POST',
                'beforeSend' => 'function(){ jQuery("#create-loader").removeClass("hidden"); }',
                'success' => 'function(html){ $("#globalModal").html(html); }',
                    ), array('class' => 'btn btn-primary', 'id' => 'forum-topic-create-submit-button'));
            ?>

            <div class="col-md-1 modal-loader">
                <div id="create-loader" class="loader loader-small hidden"></div>
            </div>
        </div>

        <?php $this->endWidget(); ?>
    </div>

</div>


<script type="text/javascript">

    // Replace the standard checkbox and radio buttons
    //$('.modal-dialog').find(':checkbox, :radio').flatelements();

    // show Tooltips on elements inside the views, which have the class 'tt'
    //$('.tt').tooltip({html: true});

    // set focus to input for space name
    $('#title').focus();

    // Shake modal after wrong validation
<?php if ($form->errorSummary($model) != null) { ?>
        $('.modal-dialog').removeClass('fadeIn');
        $('.modal-dialog').addClass('shake');
<?php } ?>


    // prevent enter key and simulate ajax button submit click
    $(document).ready(function() {
        $(window).keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                $('#forum-topic-create-submit-button').click();
            }
        });
    });

</script>