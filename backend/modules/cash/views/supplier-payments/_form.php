<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\cash\models\SupplierPayment */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="supplier-payment-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    
    <?= $form->field($model, 'supplier_id')->dropDownList(asOptions('\backend\modules\supplier\models\Supplier'),['prompt' => 'Select Supplier', 'placeholder' => 'Supplier']) ?>

    

    <?= $form->field($model, 'date')->widget(\kartik\widgets\DatePicker::classname(), [
        'options' => [
            'placeholder' => 'Choose Date',
            'value' => date('Y-m-d')
        ],
        'type' => \kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]); ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'placeholder' => 'Amount']) ?>


    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Transaction Info</legend>
        <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true, 'placeholder' => 'Amount']) ?>
        <?= $form->field($model, 'voucher_no')->textInput(['maxlength' => true, 'placeholder' => 'Amount']) ?>

    </fieldset>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
