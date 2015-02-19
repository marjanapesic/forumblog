
<?php $linkTitle = Yii::t('ForumModule.widgets_views_commentLink', "Comment");
      if($total) 
          $linkTitle .=  " (".$total.")";?>

<?php echo CHtml::link($linkTitle, "#", 
    array('onClick' => "$('#postComment_" . $id . "').show();$('#newPostComment_" . $id . "').focus();return false;")); ?>
