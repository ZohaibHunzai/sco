<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\cash\models\SupplierPayment */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Supplier Payments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-payment-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Supplier Payment'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'date',
        'amount',
        'supplier_id',
        'transaction_group',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>