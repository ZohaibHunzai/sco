<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \backend\modules\accounts\models\PrimaryAccount;

/* @var $this yii\web\View */
/* @var $model app\modules\accounts\models\SecondaryAccount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="secondary-account-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-4">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="col-md-4">

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    </div>
   
    <div class="col-md-4">

    <?= $form->field($model, 'primary_account_id')->dropDownList(asOptions(PrimaryAccount::className(), 'id', 'name') , ['prompt' => 'choose primary account']) ?>
    </div>


    <div class="col-md-12 form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
