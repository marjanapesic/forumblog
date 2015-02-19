<?php

class CommentController extends Controller
{

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    
    public function loadTarget() {
        
        $targetModelClass = Yii::app()->request->getParam('model');
        $targetModelId = (int) Yii::app()->request->getParam('id');
        
        $targetModelClass = Yii::app()->input->stripClean(trim($targetModelClass));
        
        if ($targetModelClass == "" || $targetModelId == "") {
            throw new CHttpException(500, Yii::t('ForumModule.controllers_CommentController', 'Model & Id Parameter required!'));
        }
        
        if (!Helpers::CheckClassType($targetModelClass, 'HActiveRecordContent')) {
            throw new CHttpException(500, Yii::t('ForumModule.controllers_CommentController', 'Invalid target class given'));
        }
        
        $model = call_user_func(array($targetModelClass, 'model'));
        $target = $model->findByPk($targetModelId);
        
        if (!$target instanceof HActiveRecordContent) {
            throw new CHttpException(500, Yii::t('ForumModule.controllers_CommentController', 'Invalid target class given'));
        }
        
        if ($target == null) {
            throw new CHttpException(404, Yii::t('ForumModule.controllers_CommentController', 'Target not found!'));
        }
        
        // Check if we can read the target model, so we can comment it?
        if (!$target->content->canRead(Yii::app()->user->id)) {
            throw new CHttpException(403, Yii::t('ForumModule.controllers_CommentController', 'Access denied!'));
        }
        
        return $target;
    }
    
    
    
    public function actionShow()
    {       
        
        $forumPostId = (int) Yii::app()->request->getParam('id');
        
        $target = $this->loadTarget();

                
        $output = "";

        // Get new current comments
        $comments = ForumComment::model()->findAllByAttributes(array('object_model' => get_class($target), 'object_id' => $target->id));

        foreach ($comments as $comment) {
            $output .= $this->widget('application.modules.forum.widgets.ShowComment', array('comment' => $comment), true);
        }

        Yii::app()->clientScript->render($output);
        echo $output;
        Yii::app()->end();
    }
    
    
    public function actionEdit()
    {
        $id = Yii::app()->request->getParam('id');
        $model = ForumComment::model()->findByPk($id);
    
        if ($model && $model->canWrite()) {
            
            if (isset($_POST['ForumComment'])) {
                $_POST['ForumComment'] = Yii::app()->input->stripClean($_POST['ForumComment']);
                $model->attributes = $_POST['ForumComment'];
    
                if ($model->validate()) {
                    $model->save();
    
                    // Reload comment to get populated updated_at field
                    $model = ForumComment::model()->findByPk($id);
    
                    // Return the new comment
                    $output = $this->widget('application.modules.forum.widgets.ShowComment', array('comment' => $model, 'justEdited' => true), true);
                    Yii::app()->clientScript->render($output);
                    echo $output;
                    return;
                }
            }
    
            $this->renderPartial('edit', array('comment' => $model), false, true);
        } else {
            throw new CHttpException(403, Yii::t('ForumModule.controllers_CommentController', 'Access denied!'));
        }
    }
    
    
    
    public function actionDelete()
    {
    
        $this->forcePostRequest();
        $target = $this->loadTarget();
        $commentId = (int) Yii::app()->request->getParam('cid', "");
    
        $comment = ForumComment::model()->findByPk($commentId);
    
        // Check if Comment correspond to the given Target (Access checking)
        if ($comment != null && $comment->object_model == get_class($target) && $comment->object_id == $target->id) {
    
            // Check if User can delete this Comment
            if ($comment->canDelete()) {
                $comment->delete();
            } else {
                throw new CHttpException(500, Yii::t('ForumModule.controllers_CommentController', 'Insufficent permissions!'));
            }
        } else {
            throw new CHttpException(500, Yii::t('ForumModule.controllers_CommentController', 'Could not delete comment!')); // Possible Hack attempt!
        }
    
        return $this->actionShow();
    }
    
    
    public function actionPost()
    {
    
        $this->forcePostRequest();
        $target = $this->loadTarget();
    
        $message = Yii::app()->request->getParam('message', "");
        $message = Yii::app()->input->stripClean(trim($message));
    
        if ($message != "") {
    
            $comment = new ForumComment;
            $comment->message = $message;
            $comment->object_model = get_class($target);
            $comment->object_id = $target->id;
    
               
            $comment->save();
            File::attachPrecreated($comment, Yii::app()->request->getParam('fileList'));
        }
    
        return $this->actionShow();
    }
    
    
}