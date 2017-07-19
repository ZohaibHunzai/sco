<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\modules\customers\models\Customer */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">
            Basic Info
        </legend>
        <div class="row">
            <div class="col-md-4">
                <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?php echo $form->field($model, 'cnic')->textInput(['maxlength' => true]) ?>
            </div>

            <div class="col-md-4">
                <?php echo $form->field($model, 'type')->dropDownList($model->types, ['prompt' => 'Select Customer type']) ?>
            </div>

            
            <div class="col-md-4">
                <?php echo $form->field($model, 'sales_person_id')->dropDownList(asOptions('\common\models\User', 'id', 'username'), ['prompt' => 'Select Customer type']) ?>
            </div>

            
        </div>
    </fieldset>
    <fieldset class="scheduler-border">
        <legend class="scheduler-border">
            Contact and Address
        </legend>
        <div class="row">
            <div class="col-md-4">
                 <?php echo $form->field($model, 'phone_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
               <?php echo $form->field($model, 'mobile_no')->textInput(['maxlength' => true]) ?>
            </div>
            
            <div class="col-md-4">
                <?php echo $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?php echo $form->field($model, 'region_id')->dropDownList(asOptions('\backend\modules\init\models\Region'), ['prompt' => 'Select Town', 'data-url' => Url::to(['/customers/default/towns'])]) ?>
            </div>
            <div class="col-md-4">
                <?php echo $form->field($model, 'town_id')->dropDownList(asOptions('\backend\modules\init\models\Town'), ['prompt' => 'Select Town']) ?>
            </div>

            <div class="col-md-12">
                <?php echo $form->field($model, 'address')->textArea(['maxlength' => true]) ?>
            </div>


            
        </div>
    </fieldset>

   

     <fieldset class="scheduler-border">
        <legend class="scheduler-border">Payments</legend>
        <div class="row">
            <div class="col-md-6">
                <?php echo $form->field($model, 'opening_balance')->textInput() ?>
            </div>
        </div>
    </fieldset>




    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Add New Customer' : 'Update Customer', ['class' => $model->isNewRecord ? 'btn btn-success btn-flat btn-block btn-lg' : 'btn btn-primary btn-flat btn-block btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
