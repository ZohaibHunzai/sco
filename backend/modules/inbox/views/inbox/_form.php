<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\inbox\models\Thread */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="thread-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'created_for')
    	->dropDownList($model->toUsers, [
	    	'prompt' => 'Select User',
	    ]) 
	?>
    <?php echo $form->field($mModel, 'message')->textArea() ?>


    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
