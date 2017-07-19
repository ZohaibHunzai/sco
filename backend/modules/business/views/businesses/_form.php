<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use marqu3s\summernote\Summernote;
$this->registerCssfile("@web/summernote/summernote.css");
$this->registerJsFile("@web/summernote/summernote.min.js",[
    "depends" => 'backend\assets\BackendAsset'
]);
/* @var $this yii\web\View */
/* @var $model backend\modules\business\models\Business */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="business-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'placeholder' => 'Address']) ?>

    <?= $form->field($model, 'phone_number')->textInput(['placeholder' => 'Phone Number']) ?>

    <?= $form->field($model, 'photo_id')->textInput(['placeholder' => 'Photo']) ?>

   <?= $form->field($model, 'invoice_header')->widget(Summernote::className(), [
    'clientOptions' => [
            // ...
        ]
    ]) ?>
    <?= $form->field($model, 'invoice_footer')->widget(Summernote::className(), [
    'clientOptions' => [
        // ...
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
    $this->registerJs("
        $('.summernote').summernote();
    ")
 ?>