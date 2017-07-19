<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use backend\modules\sales\models\Sale;
use kartik\grid\GridView;
use backend\modules\business\models\Business;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sales\models\SaleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sale';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);



$business = Business::find()->one();

$pdf_title = "
    <div style='text-align:center'>
        <p style='text-align:center'>Sales List Report</p>
    </div>
";
$file_name = time() . "-" . ' cash-recovery-report';

$pdf_title = $business->format($business->invoice_header, $pdf_title);

?>
<div class="sale-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sale', ['create'], ['class' => 'btn btn-default btn-flat']) ?>
        <?= Html::a('Reset Search', ['index'], ['class' => 'btn btn-default btn-flat']) ?>
    </p>
        <div class="search-form" style="display:none">
        <?=  $this->render('_search', ['model' => $searchModel]); ?>
    </div>
        <?php 
    $gridColumn = [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute' => 'id',
            // 'filter' => false
            'width' => '60px',
        ],
        // 'order_id',  
        // 'store_id',
        [
            'attribute' => 'date',
            'filterType' => GridView::FILTER_DATE_RANGE,
            'filterWidgetOptions' => [
                'presetDropdown' => true,
                'pluginOptions' => [
                    'locale'=>[
                        'format'=>'Y-M-D',
                        'separator'=>' - ',
                    ],
                ]
            ],
            'format' => 'date',
            'width' => '140px',
        ],
        [
            'attribute' => 'customer_id',
            'value' => 'customer.name',
            'label' => 'Customer',
            'filter' => asOptions('\backend\modules\customers\models\Customer'),
            'width' => '156px',
        ],
        [
            'label' => 'Items Qty',
            'width' => '60px',
            'value' => 'saleQuantity',
            'pageSummary' => true,
        ],
        [
            'attribute' => 'net_total',
            'format' => 'decimal',
            'pageSummary' => true
        ],
        [
            'attribute' => 'discount',
            'format' => 'decimal',
            'pageSummary' => true
        ],

        [
            'attribute' => 'grand_total',
            'format' => 'decimal',
            'pageSummary' => true
        ],
        [
            'label' => 'cost',
            'value' => function($m){
                return Sale::totalCost($m->id);
            },
            'visible' => false,
        ],
        [
            'attribute' => 'is_return',
            'filter' => [
                // 0 => 'Sales',
                1 => 'Sales Return',
            ]
        ],
        [
            'label' => 'invoice',
            'value' => function($m){
                return Html::a("Invoice", ['/sales/sale-items/index', 'id' => $m->id], ['class' => 'btn btn-sm btn-flat btn-default']);
            },
            'format' => 'raw',
            'hiddenFromExport' => true,

        ],
        [   
            'attribute' => 'status',
            'hiddenFromExport' => true,
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{view} {delete} {print}',
            // 'template' => '{view} {update} {my_button}',
                'buttons' => [
                    'print' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-print"></i>', ['print', 'id'=>$model->id], [
                            'data-toggle' => 'tooltip',
                            'title' => 'Print Thermal',
                        ]);
                    },
                ]
        ],
    ]; 
    ?>
    <?= GridView::widget([
        
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'showPageSummary' =>  true,
        // 'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        // 'pjax' => true,
        // 'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // set a label for default menu
         'export' => [
            'label' => 'Page',
            'fontAwesome' => true,
            'target' => GridView::TARGET_BLANK,
            'showConfirmAlert' => false,
        ],
        'exportConfig' => [
          'pdf' => [
            'filename' => $file_name, 
            'config' => [
                'contentBefore' => $pdf_title,
                'contentAfter' => $business->invoice_footer,
                'methods' => [
                'setHeader' => [
                    [
                        'odd' => [
                            'L' => [
                                'content' => 'Report generated on ' . date("D, d-M-Y g:i a"),
                                'font-size' => 8,
                                'color' => '#333333'
                            ],
                            'R' => [
                                'content' => 'By: ' . Yii::$app->user->identity->username,
                                'font-size' => 8,
                                'color' => '#333333'
                            ],

                        ]
                    ]
                ],
                'setFooter' => [
                    [
                        'odd' => [
                            'R' => [
                                'content' => 'Page: {PAGENO}',
                                'font-size' => 12,
                                'color' => '#333333'
                            ],
                            'L' => [
                                'content' => 'uConnect Software (05811-455061)',
                                'font-size' => 10,
                                'color' => '#333333'
                            ],

                        ]
                    ]
                ],

              ]
            ]
          
          ],
          GridView::EXCEL => [],
          GridView::HTML => [],
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
