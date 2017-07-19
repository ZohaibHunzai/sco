<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use backend\modules\business\models\Business;


/* @var $this yii\web\View */
/* @var $searchModel backend\modules\customers\models\search\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customers';
$this->params['breadcrumbs'][] = $this->title;
// ------------------------------------

$business = Business::find()->one();

$pdf_title = "
    <div style='text-align:center'>
        <p style='text-align:center'>Customer List</p>
    </div>
";
$file_name = time() . "-" . ' customer-list';

$pdf_title = $business->format($business->invoice_header, $pdf_title);


// --------------------------------------


?>
<div class="facts">
    <div class="row">
        <div class="col-md-3">
            <?= box("Total Customers", aggregate('\backend\modules\customers\models\Customer', 'id'), 'fa-users') ?>
        </div>
        <div class="col-md-3 hide">
            <?= box("Total Recievalbes", 30000, 'fa-dollar', 'bg-green') ?>
        </div>
    </div>

</div>
<hr />
<div class="customer-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Customer', ['create'], ['class' => 'btn btn-default  btn-flat']) ?>
        <?php echo Html::a('Reset Search', ['index'], ['class' => 'btn btn-default btn-flat']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
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
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            // 'id',
            'name',
            [
                'attribute' => 'town_id',
                'value' => 'town.name',
                'filter' => asOptions('\backend\modules\init\models\Town'),
                'label' => 'Town',
                'width' => '130px'
            ],
            [
                'attribute' => 'sales_person_id',
                'label' =>  'Person',
                'value' => 'person.username',
                'filter' => asOptions('\common\models\User', 'id', 'username'),
                'width' => '130px'

            ],
            // 'mobile_no',
            // 'email:email',
            // 'created_at:Date',
            [
                'attribute' => 'cashSales',
                'pageSummary' => true,
                'format' => 'decimal',
            ],

            [
                'attribute' => 'creditSales',
                'pageSummary' => true,
                'format' => 'decimal',
                'label' => 'Cr/Sales'
            ],
            
            [
                'attribute' => 'opening_balance',
                'pageSummary' => true,
                'format' => 'decimal',
                'label' => 'Opening',
            ],
            [
                'attribute' => 'received',
                'pageSummary' => true,
                'format' => 'decimal',
            ],

            [
                'attribute' => 'returned',
                'pageSummary' => true,
                'format' => 'decimal',
            ],




            // 'type',
            [
                'attribute' => 'balance',
                'pageSummary' => true,
                'format' => 'decimal',
            ],

            
            // 'address',

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]); ?>

</div>
