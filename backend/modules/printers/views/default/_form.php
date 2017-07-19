<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\printers\models\Printer;

/* @var $this yii\web\View */
/* @var $model backend\modules\printers\models\Printer */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="printer-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'description')->textArea(['maxlength' => true, 'placeholder' => 'Description']) ?>

    <?= $form->field($model, 'type')->dropDownList(Printer::TypeOptions(), ['placeholder' => 'Type']) ?>
    <?= $form->field($model, 'footer')->textArea(['maxlength' => true, 'placeholder' => 'Description']) ?>
    
    <?= $form->field($model, 'is_default')->checkBox(['maxlength' => true, 'placeholder' => 'Description']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
