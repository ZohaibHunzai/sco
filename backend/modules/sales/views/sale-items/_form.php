<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\sales\models\SaleItem */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="sale-item-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'sale_id')->textInput(['placeholder' => 'Sale']) ?>

    <?= $form->field($model, 'product_id')->textInput(['placeholder' => 'Product']) ?>

    <?= $form->field($model, 'quantity')->textInput(['placeholder' => 'Quantity']) ?>

    <?= $form->field($model, 'discount')->textInput(['placeholder' => 'Discount']) ?>

    <?= $form->field($model, 'total')->textInput(['placeholder' => 'Total']) ?>

    <?= $form->field($model, 'quantity_unit')->textInput(['placeholder' => 'Quantity Unit']) ?>

    <?= $form->field($model, 'tonnage')->textInput(['placeholder' => 'Tonnage']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
