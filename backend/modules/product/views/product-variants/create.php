<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\ProductVariantList */

$this->title = 'Create Product Variant List';
$this->params['breadcrumbs'][] = ['label' => 'Product Variant Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-variant-list-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
