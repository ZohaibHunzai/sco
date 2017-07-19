<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\cash\models\SupplierPayment */

$this->title = 'Update Supplier Payment: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Supplier Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="supplier-payment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
