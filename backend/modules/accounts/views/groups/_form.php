<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\accounts\models\AccGroup */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="acc-group-form">

    <?php $form = ActiveForm::begin([
    	// 'layout' => isset($inline) ? 'inline' : 'horizontal',
    	'action' => ['/accounts/groups/create']
    ]); ?>
    
    <?= $form->errorSummary($model); ?>

    

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'code')->textInput(['placeholder' => 'Code']) ?>

    <?= $form->field($model, 'status')->dropDownList(statuses(), ['prompt' => 'Select Status','placeholder' => 'Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
