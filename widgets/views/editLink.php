<li>
    <?php
    echo HHtml::ajaxLink('<i class="fa fa-pencil"></i> ' . Yii::t('ForumBlogModule.widgets_views_editLink', 'Edit'), Yii::app()->createUrl($editRoute, array('id' => $id)), array(
        'success' => "js:function(html){ $('.preferences .dropdown').removeClass('open'); $('#wall_content_" . $object->getUniqueId() . "').replaceWith(html); }"
    ));
    ?>
</li>