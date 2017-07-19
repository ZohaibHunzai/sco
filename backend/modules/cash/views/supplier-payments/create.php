<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cash\models\SupplierPayment */

$this->title = 'Create Supplier Payment';
$this->params['breadcrumbs'][] = ['label' => 'Supplier Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-payment-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
