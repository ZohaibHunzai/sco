<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\modules\init\models\Brand;
use backend\modules\init\models\BrandSector;
/* @var $this yii\web\View */
/* @var $model backend\modules\init\models\Brand */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="brand-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Name']) ?>

    <?= $form->field($model, 'status')->dropDownList(statuses(), ['placeholder' => 'Status', 'prompt' => 'Set status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
