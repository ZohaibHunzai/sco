<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\init\models\Unit */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="unit-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'symbol')->textInput(['maxlength' => true, 'placeholder' => 'Symbol']) ?>
    <?= $form->field($model, 'tonnage_unit')->textInput(['maxlength' => true, 'placeholder' => 'Symbol']) ?>

    <?= $form->field($model, 'status')->dropDownList(statuses(), ['promp' => 'Select Status', 'placeholder' => 'Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
