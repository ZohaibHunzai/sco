<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\supplier\models\Supplier */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="supplier-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">   
        <div class="col-md-4">
            <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-md-4">
            <?php echo $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>
        </div>


    </div>

    <div class="row">
        <div class="col-md-4">
             <?php echo $form->field($model, 'mobile_no')->textInput(['maxlength' => true]) ?>
            
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'fax_number')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'credit_limit')->textInput(['maxlength' => true]) ?>
        </div>
        
    </div>

    <?php echo $form->field($model, 'address')->textArea(['maxlength' => true]) ?>


    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Payments</legend>
        <?= $form->field($model, 'opening_balance') ?>
    </fieldset>

    
    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Add Supplier' : 'Save Supplier', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
