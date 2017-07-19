<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\modules\expenses\models\Expense */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="expense-form">

  <?php $form = ActiveForm::begin(); ?>

  <?= $form->errorSummary($model); ?>

  <fieldset class="scheduler-border">
    <legend class="scheduler-border">Expense Details</legend>

    <div class="row">
      <div class="col-md-6">
        <?= $form->field($model, 'amount')->textInput(['maxlength' => true, 'placeholder' => 'Amount']) ?>
      </div>
      <div class="col-md-6">
        <?= $form->field($model, 'date')->widget(\kartik\widgets\DatePicker::classname(), [
          'options' => ['placeholder' => 'Choose Date', 'value' => date('Y-m-d')],
          'type' => \kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
          'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
          ]
        ]); ?>
      </div>
    </div>

    <?= $form->field($model, 'comment')->textArea(['maxlength' => true, 'placeholder' => 'Comment']) ?>


  </fieldset>

  <fieldset class="scheduler-border">
    <legend class="scheduler-border">Accounts</legend>

    <div class="row">
      <div class="col-md-6">
        <?php echo $form->field($model, 'expense_account')
          ->widget(
            Select2::className(),
            [
              'data' => $model->getExpenseAccounts(),
              'options' => ['placeholder' => 'Select an Account.'],
            ]


          ) ?>
      </div>
      <div class="col-md-6">
        <?php echo $form->field($model, 'payment_account')
          ->widget(
            Select2::className(),
            [
              'data' => $model->getPaymentAccounts(),
              'options' => [
                  'placeholder' => 'Select an Account.',
                  // 'selected' => $model->payment_account
                ],
              'pluginOptions' => [
                'selected' => $model->payment_account
              ]
            ]


          ) ?>
      </div>

    </div>

  </fieldset>


  <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? 'Add Expense' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
