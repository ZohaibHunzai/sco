<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\modules\price\models\Price */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="price-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'total_units')->textInput() ?>
    <fieldset class="scheduler-border hidden ">
        <legend class="scheduler-border">Unit Prices</legend>
        <?php echo $form->field($model, 'unit_selling_price')->textInput() ?>
        <?php echo $form->field($model, 'unit_purchase_price')->textInput() ?>
    </fieldset>


    <?php echo $form->field($model, 'selling_price')->textInput() ?>
    <?php echo $form->field($model, 'purchase_price')->textInput() ?>


    <?php echo $form->field($model, 'date')->widget(
            DatePicker::classname(), [
            'options' => [
                'placeholder' => 'Enter Opening Date ...', 
                'value'=>date('Y-m-d')
            ],
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'autoclose' => true,
                  'format' => 'yyyy-mm-dd',
            ]
        ]) ?>


    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!-- <?php 
    $this->registerJs(
    '$(document).ready(function(){
        $("#price-unit_purchase_price").keyup(function(){
            var v = parseFloat($(this).val());
            var units = parseFloat($("#price-total_units").val());
            var total = v * units;
            $("#price-purchase_price").prop("value", Number(total).toFixed(2) );
        })
        
        $("#price-unit_selling_price").keyup(function(){
            var v = parseFloat($(this).val());
            var units = parseFloat($("#price-total_units").val());
            var total = v * units;
            $("#price-selling_price").prop("value", Number(total).toFixed(2) );
        })

        $("#price-selling_price").keyup(function(){
            var v = parseFloat($(this).val());
            var units = parseFloat($("#price-total_units").val());
            var total = v / units;
            $("#price-unit_selling_price").prop("value", Number(total).toFixed(2) );
        })

        $("#price-purchase_price").keyup(function(){
            var v = parseFloat($(this).val());
            var units = parseFloat($("#price-total_units").val());
            var total = v / units;
            $("#price-unit_purchase_price").prop("value", Number(total).toFixed(2) );
        })



    });'
    );
?> -->
<script type="text/javascript">
    
</script>
