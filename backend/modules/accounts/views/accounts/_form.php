<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\Constants;
use \backend\modules\accounts\models\PrimaryAccount;
use \backend\modules\accounts\models\SecondaryAccount;
use \backend\modules\accounts\models\AccGroup as Group;

/* @var $this yii\web\View */
/* @var $model app\modules\accounts\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

        
    <?php echo $form->field($model, 'primary_account_id')->dropDownList(
        asOptions(PrimaryAccount::className(), 'id', 'name'),
        ['prompt' => 'Choose primary account',
            'onchange' => '
                $.post("' . Yii::$app->urlManager->createUrl('accounts/accounts/lists?id=') .
                '"+$(this).val(),function( data ) 
                {
                  $( "select#account-secondary_account_id" ).html( data );
                });'
        ]);
    ?>









    <?php echo $form->field($model, 'secondary_account_id')
        ->dropDownList(
            asOptions(SecondaryAccount::className(), 'id', 'name'),
            ['id' => 'account-secondary_account_id',
                'prompt' => 'choose Secondary account',
            ]
        );
    ?>




    <?php echo $form->field($model, 'is_system_account')
        ->checkBox();
    ?>


    <div class=" form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-flat btn-block' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
