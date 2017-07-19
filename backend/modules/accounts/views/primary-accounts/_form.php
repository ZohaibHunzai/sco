<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\accounts\models\PrimaryAccount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="primary-account-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="col-md-4">
        

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    </div>

    <div class="col-md-4 form-group" style="margin-top: 25px;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
