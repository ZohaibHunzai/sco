<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\customers\models\Customer as C;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\modules\cash\models\CashCollection */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="cash-collection-form" id="cash-collection-create">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>
    <?php echo $form->field($model, 'customer_id')
            ->widget(Select2::className(), [
                'data' => C::asSalesOptions(),
                'options' => ['placeholder' => 'Select a Customer.'],
            ]);
    ?>

    <?php echo $form->field($model, 'type')
            ->widget(Select2::className(), [
                'data' => $model->getTypes(),
                'options' => [
                    'placeholder' => 'Select Collection Mode.', 
                    'class' => 'recieve-mode'
                ],
            ]);
    ?>

    <fieldset class="scheduler-border bank-account-details hide">
        <legend class="scheduler-border">Account Details</legend>
         <?php echo $form->field($model, 'bank_account')
            ->widget(Select2::className(), [
                'data' => $model->bankAccounts,
                'options' => ['placeholder' => 'Select Collection Mode.'],
            ]);
        ?>

        <?= $form->field($model, 'narration')->textArea([
            'placeholder' => 'Details - Cheque number etc'
        ]) ?>
    </fieldset>
    

    <?= $form->field($model, 'date')->widget(\kartik\widgets\DatePicker::classname(), [
        'options' => ['placeholder' => 'Choose Date', 'value' => date("Y-m-d")],
        'type' => \kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',


        ]
    ]); ?>

    <?= $form->field($model, 'amount')->textInput(['placeholder' => 'Amount']) ?>

    <?= $form->field($model, 'sales_person_id')->dropDownList(asOptions('\common\models\User', 'id', 'username'), ['placeholder' => 'Sales Person']) ?>

    


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
