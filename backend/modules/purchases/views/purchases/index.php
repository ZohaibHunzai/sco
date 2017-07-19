<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\purchases\models\PurchaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recieve Inventory';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="purchase-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('New Recieve Inventory', ['create'], ['class' => 'btn btn-default btn-flat']) ?>

    </p>

        <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'hidden' => true],
        [
            'attribute' => 'bill_no',
            'width' => '80px',
            // ''
        ],
        [
            'attribute' => 'date',
            'label' => 'Date',
            'format' => 'date',
            'width' => '130px',
        ],
        // 'store_id',
        [
          'attribute' =>  'comments',
          'filter' => false,
          'width' => '150px',
        ],
        [
            'attribute' => 'supplier_id',
            'value' => 'supplier.name',
            'label' => 'Supplier',
            'width' => '130px',
            'filter' => false,
        ],

        [
            'label' => 'Invoice Items',
            'value' => 'purchaseCount', 
        ],
        [
            'label' => 'Items Quantity',
            'value' => 'purchaseQuantity', 
        ],
        [
            'label' => 'Author',
            'value' => 'author.publicIdentity',
        ],
        [
            'attribute' => 'grand_total',
            'filter' => false,
        ],
        [
            'class'=>'kartik\grid\ExpandRowColumn',
            'width'=>'50px',
            'label' => 'Sizes Detail',
            'value'=>function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail'=>function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_view', ['model'=>$model]);
            },
            'headerOptions'=>['class'=>'kartik-sheet-style'] ,
            'expandOneOnly'=>true,
        ],
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        // 'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // set a label for default menu
        'export' => [
            'label' => 'Page',
            'fontAwesome' => true,
        ],
        // your toolbar can include the additional full export menu
        // 'toolbar' => [
        //     '{export}',
        //     ExportMenu::widget([
        //         'dataProvider' => $dataProvider,
        //         'columns' => $gridColumn,
        //         'target' => ExportMenu::TARGET_BLANK,
        //         'fontAwesome' => true,
        //         'dropdownOptions' => [
        //             'label' => 'Full',
        //             'class' => 'btn btn-default',
        //             'itemsBefore' => [
        //                 '<li class="dropdown-header">Export All Data</li>',
        //             ],
        //         ],
        //     ]) ,
        // ],
    ]); ?>

</div>
