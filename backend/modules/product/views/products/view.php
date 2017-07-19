<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\Product */


$this->title = "Article " . $model->code . " - " . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Article', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="btn-group hide">
            <?= Html::a("New", ['/products/products/create'], ['class' => 'btn btn-default btn-flat']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a("Previous", ['/products/products/previous', 'id' => $model->id], ['class' => 'btn btn-default btn-flat']) ?>
            <?= Html::a("Next", ['/products/products/next', 'id' => $model->id], ['class' => 'btn btn-default btn-flat']) ?>
            <?= Html::a("Articles", ['/products/products/index'], ['class' => 'btn btn-default btn-flat']) ?>
            <?= Html::a("<i class='fa fa-plus'></i> Add Inventory", ['/inventory/inventory/create', 'product_id' => $model->id], ['class' => 'btn btn-default btn-flat']) ?>



        </div>
        <hr />
    </div>
</div>
<div class="product-view">
    <h3>Basic Info</h3>
  

    <?php echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'barcode',
            'description',
            'category.name',
            'price.selling_price',
            'price.purchase_price',
            'price.margin',
        ],
    ]) ?>
    <h3>Size Information</h3>
    <?php echo $this->render("_size-details", ['model' => $model]); ?>
</div>
