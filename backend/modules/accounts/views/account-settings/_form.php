<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \backend\modules\accounts\models\Account;

/* @var $this yii\web\View */
/* @var $model backend\modules\accounts\models\AccountSetting */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="account-setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'key')->textInput() ?>
    <?php echo $form->field($model, 'name')->textInput() ?>

    <?php echo $form->field($model, 'value')->dropDownList(asOptions(Account::className(), 'id', 'name'), ['prompt' => 'Select Account']) ?>


    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
