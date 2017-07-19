<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\inventory\models\InventorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Inventory', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'product_id',
                'value' => 'product.name',

            ],
            [
                'attribute' => 'location_id',
                'value' => 'location.name'
            ],
            'quantity',
            'price.purchase_price:decimal:Purchase Cost',
            'price.selling_price:decimal:Selling Price',
            'price.margin:decimal:Margin',
            // 'created_by',
            // 'updated_by',
            // 'created_at:relativeTime:Added On',
            // 'updated_at',
            // 'price_id',
            // 'supplier_id',
            // 'mfg_date',
            // 'expirity_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
