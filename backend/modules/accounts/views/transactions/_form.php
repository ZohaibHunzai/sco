<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\modules\accounts\models\Account;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model backend\modules\accounts\models\Transaction */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-md-6">
            <?php echo $form->field($model, 'mode')->dropDownList($model->modes, ['prompt' => 'Select Mode']) ?>
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'type')->dropDownList($model->types, ['prompt' => 'Transaction type']) ?>
            
        </div>
        

    </div>

    <div class="row">
        <div class="col-md-6">
            <?php echo $form->field($model, 'account_id')
                ->widget(
                    Select2::className(), 
                    [
                        'data' => asOptions(Account::className(), 'id', 'name'),
                        'options' => ['placeholder' => 'Select an Account.'],
                    ]


                ) ?>
            
        </div>
        <div class="col-md-6">
            <?php echo $form->field($model, 'amount')->textInput() ?>
        </div>
    </div>



    <?php echo $form->field($model, 'narration')->textArea(['maxlength' => true]) ?>

    
    
    <div id="transfer-from">
        <h4>Transfer To</h4>
        <hr />
        <div class="row">
            <div class="col-md-4">
                <?php echo $form->field($model, 'transfer_account_id')
                    ->widget(
                        Select2::className(), 
                        [
                            'data' => asOptions(Account::className(), 'id', 'name'),
                                'options' => ['placeholder' => 'Select an Account.'],
                            ]


                ) ?>
            </div>
            <div class="col-md-4">
                <?php echo $form->field($model, 'transfer_amount')->textInput() ?>
                
            </div>
            <div class="col-md-4">
                <?php echo $form->field($model, 'transfer_narration')->textInput() ?>
                
            </div>

        </div>
    
    
    </div>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
