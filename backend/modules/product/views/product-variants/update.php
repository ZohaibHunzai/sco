<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\ProductVariantList */

$this->title = 'Update Product Variant List: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product Variant Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-variant-list-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
