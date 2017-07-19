<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\Constants;
use kartik\file\FileInput;
use backend\modules\product\models\ProductVariantList as PVL;
use backend\modules\product\models\Product;
/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\Product */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        // 'layout' => 'horizontal',
        'options' => [
            'id' => 'product-setup-form',
        ]
    ]); ?>

    <?php echo $form->errorSummary($model); ?>

    <fieldset class="scheduler-border">
        <legend class="scheduler-border">Definitions</legend>
             <div class="row">
                
                <div class="col-md-6">
                    <?php echo $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    
                </div>
               
                 <div class="col-md-6">
                
                    <?php echo $form->field($model, 'barcode')->textInput([
                    'maxlength' => true,
                    'class' => 'barcode form-control',
                    ]) ?>

                </div>
            </div>
            <div class="row">
                
                <div class="col-md-6">
                
                    <?php echo $form->field($model, 'purchase_price')->textInput([
                        'maxlength' => true,
                        'class' => 'barcode form-control',

                    ]) ?>

                </div>

                <div class="col-md-6">
                
                    <?php echo $form->field($model, 'selling_price')->textInput([
                        'maxlength' => true,
                        'class' => 'barcode form-control',

                    ]) ?>

                </div>
                
               

                 
            </div>
            <div class="row">
                  
                    <div class="col-md-6">
                            
                            <?php echo $form->field($model, 'brand_id')->dropDownList(asOptions('backend\modules\init\models\Brand', 'id', 'name'), ['prompt' => 'Select Brand', 'maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                            
                            <?php echo $form->field($model, 'brand_sector_id')->dropDownList(asOptions('backend\modules\init\models\BrandSector', 'id', 'name'), ['prompt' => 'Select Brand', 'maxlength' => true]) ?>
                    </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    
                    <?php echo $form->field($model, 'category_id')->dropDownList(asOptions('backend\modules\categories\models\Category', 'id', 'name'), ['prompt' => 'Select Category', 'maxlength' => true]) ?>
                </div>
                <?php if ($model->isNewRecord): ?> 
                   <div class="col-md-6">
                       <?php echo $form->field($model, 'available_sizes')->textInput(['placeholder' => 'Comma separated size numbers. e.g. 6,7,8']) ?>
                   </div>


                <?php endif ?>
            </div>
               <!-- </div> -->
                <div class="col-md-12 hide">
                    <?php echo $form->field($model, 'description')->textArea(['maxlength' => true]) ?>
                </div>
            </div>
    </fieldset>
   
     

   


    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Add New Article' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success btn-lg' : 'btn btn-primary btn-lg']) ?>
        <?php echo Html::a("Cancel", ['index'], ['class' => 'btn btn-danger btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

