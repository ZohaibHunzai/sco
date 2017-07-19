<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use backend\modules\business\models\Business;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sales\models\SaleItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sale Invoice';
$this->params['breadcrumbs'][] = ['url' => ['/sales/sales/index'], 'label' => 'Sales'];
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);

$business = Business::find()->one();

$pdf_title = "
    <div style='text-align:center'>
        <p style='text-align:center'>Sale Invoice as of " . date("M d, Y", strtotime($sale->date)) . "</p>
        <p style='text-align:center'>Customer Name: {$sale->customer->name}</p> 
        <p style='text-align:center'>{$sale->customer->address}</p> 

        <p>Sales Person: {$sale->salesPerson->username}</p>
    </div>
";
$file_name = time() . "-" . ' sale-invoice';

$pdf_title = $business->format($business->invoice_header, $pdf_title);
$me = Yii::$app->user->identity->username;
?>
<div class="sale-item-index">

    <div class="row">
        <div class="col-md-4">
            <?= Html::a("New Sale", ['/sales/sales/create'], ['class' => "btn btn-default btn-flat"]) ?>
            <?= Html::a("Print Thermal", ['/sales/sales/print', 'id' => $sale->id, 'back' => Url::to()], ['class' => "btn btn-default btn-flat"]) ?>
        </div>
    </div>

    <br />
 
        <?php 
    $gridColumn = [
        ['class' => 'kartik\grid\SerialColumn'],
        // ['attribute' => 'id', 'hidden' => true],
        // ['attribute' => 'sale_id', 'hidden' => true],
        [
            'attribute' => 'product_id',
            'value' => 'product.name',
            'label' => 'Product',
        ],
        
        [
            'attribute' => 'quantity',
            'pageSummary' => true,
        ],
        [
            'attribute' => 'discount',
            'pageSummary' => true,
        ],

        // 'discount',
        // 'quantity_unit',
        'tonnage',
        [
            'attribute' => 'total',
            'pageSummary' => true,
        ],

        // [
        //     'class' => 'yii\grid\ActionColumn',
        // ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => ,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'showPageSummary' => true,
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
                                'content' => 'By: ' . $me,
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
