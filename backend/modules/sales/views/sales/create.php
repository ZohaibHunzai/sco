<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\sales\models\Sale */

$this->title = $model->is_return == 1 ? 'Sales Return' : 'Create Sale';
$this->params['breadcrumbs'][] = ['label' => 'Sale', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sale-create">


    <?= $this->render('form2', [
        'model' => $model,
        'items' => $items,
        
        // 'products' => $products,
    ]) ?>

</div>
