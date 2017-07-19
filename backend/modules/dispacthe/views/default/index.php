<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use backend\modules\dispacthe\models\Dispacthe;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\dispacthe\models\DispatcheSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dispatches';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="dispacthe-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Dispacthe', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Advance Search', '#', ['class' => 'btn btn-info search-button']) ?>
    </p>
        <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
        <?php 
    $gridColumn = [
        ['class' => 'kartik\grid\SerialColumn'],
        ['attribute' => 'id', 'hidden' => true],
        [
            'attribute' => 'bill_no',
            'width' => '80px',
        ],
        'date:dateTime',
        [
            'attribute' => 'store_id',
            'value' => 'stores.name',
            'label' => 'Store',
            'pageSummary' => 'Total',
            'filter' => asOptions('backend\modules\init\models\Store', 'id', 'name', 'id <> ' . Yii::$app->user->identity->store_id)
        ],
        [
            'attribute' => 'type',
            'value' => 'typeText',
            'filter' => [
                Dispacthe::TYPE_RECEIVED => 'Received',
                Dispacthe::TYPE_SENT => 'Sent',
            ]
        ],
        [
            'label' => 'Total Qty',
            'value' => 'dispatchQuantity',
            'pageSummary' => true,
        ],
        [
            'label' => 'G-Total',
            'value' => 'total',
            'pageSummary' => true,

        ],

        [
            'attribute' => 'comments',
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
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{view} {delete}',
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'showPageSummary' => true,
        // set a label for default menu
        'export' => [
            'label' => 'Page',
            'fontAwesome' => true,
        ],
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
            ]) ,
        ],
    ]); ?>

</div>
