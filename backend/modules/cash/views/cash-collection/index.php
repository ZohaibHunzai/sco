<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use backend\modules\cash\models\CashCollection;
use backend\modules\business\models\Business;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\cash\models\CashCollectionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cash Collections';
$this->params['breadcrumbs'][] = $this->title;


$business = Business::find()->one();

$pdf_title = "
    <div style='text-align:center'>
        <p style='text-align:center'>Cash Recovery Report</p>
    </div>
";
$file_name = time() . "-" . ' cash-recovery-report';

$pdf_title = $business->format($business->invoice_header, $pdf_title);

?>
<div class="cash-collection-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cash Collection', ['create'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Reset Search', ['index'], ['class' => 'btn btn-default']) ?>
        <?php 
    $gridColumn = [
        ['class' => 'kartik\grid\SerialColumn'],
        ['attribute' => 'id', 'hidden' => true],
        // 'customer_id',
        [
            'attribute' => 'date',
            'filterType' => GridView::FILTER_DATE_RANGE,
            'filterWidgetOptions' => [
                'presetDropdown' => true,
                'pluginOptions' => [
                    'locale'=>[
                        'format'=>'Y-M-D',
                        // 'separator'=>' - ',
                    ],
                ]
            ],
            'format' => 'date',
            'width' => '140px',
        ],
        // 'salesPerson.username:Collector',
        [
            'attribute' => 'customer_id',
            'value' => function($model) {
                return $model->customer->name . " " .Html::a("<i class='fa fa-link'></i>", ['/customers/default/view','id' => $model->customer->id]);
            },  
            'format' => 'raw',
            'pageSummary' => 'Total',
            'filter' => asOptions('backend\modules\customers\models\Customer', 'id', 'name', ['id' => CashCollection::customerIDs()] )
        ],
        [
            'attribute' => 'amount',
            'format' => 'decimal',
            'pageSummary' => true,
        ],
        [
            'attribute' => 'transaction_group',
        ],
        [
            'label' => 'Balance',
            'format' => 'decimal',
            'pageSummary' => true,
            'value' => 'customer.balance'
        ],
        // 'status',
        // 'sale_id',
        [
            'class' => 'kartik\grid\ActionColumn',
            'template' => '{view}{delete}',
        ],
    ]; 
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'showPageSummary' =>  true,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        // set a label for default menu
        'export' => [
            'label' => 'Page',
            'fontAwesome' => true,
        ],
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
        //         // 'dropdownOptions' => [
        //         //     'label' => 'Full',
        //         //     'class' => 'btn btn-default',
        //         //     'itemsBefore' => [
        //         //         '<li class="dropdown-header">Export All Data</li>',
        //         //     ],
        //         // ],
        //     ]) ,
        // ],
    ]); ?>

</div>
