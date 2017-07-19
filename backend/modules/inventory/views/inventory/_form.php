<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use \backend\modules\locations\models\Location;
use \backend\modules\supplier\models\Supplier;
use \backend\modules\init\models\Store;
use \backend\modules\product\models\Product;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\modules\inventory\models\Inventory */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="inventory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <div>
                
        </div>
    </div>
    <?php echo $form->field($model, 'product_id')->dropDownList(asOptions(Product::className(), 'id', 'name'), 
         [
            'maxlength' => true, 
            'prompt' => 'Select Product',
            'data-request' => Url::to(['/products/products/view'])
    ]) ?>

    <?php echo $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'store_id')->dropDownList(asOptions(Store::className(), 'id', 'name'),['maxlength' => true, 'prompt' => 'Please Select Store']) 
    ?>


    

    <?php echo $form->field($model, 'supplier_id')->dropDownList(asOptions(Supplier::className(), 'id', 'name'), ['prompt' => 'Select Supplier']) ?>

    <?php echo $form->field($model, 'mfg_date')->widget(DatePicker::className(), dps()) ?>

    <?php echo $form->field($model, 'expirity_date')->widget(DatePicker::className(), dps()) ?>

    <?= $form->field($model, 'price_changed')->checkBox() ?>
    <div class="prices">
        <?php echo $form->field($model, 'purchase_price', ['options' =>  ['class' => '']])->textInput(['maxlength' => true]) ?>
        <?php echo $form->field($model, 'selling_price', ['options' =>  ['class' => '']])->textInput() ?>
    </div>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
