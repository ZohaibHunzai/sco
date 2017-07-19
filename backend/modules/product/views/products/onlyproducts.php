<?php 
use yii\helpers\Html;
use kartik\grid\GridView;
use backend\modules\business\models\Business;



$this->title = 'Articles Stock';
$this->params['breadcrumbs'][] = $this->title;

$business = Business::find()->one();

$pdf_title = "
    <div style='text-align:center'>
        <p style='text-align:center'>Articles Stock Report as of {$business->getDate()}</p>
    </div>
";
$file_name = time() . "-" . ' sale-invoice';

$pdf_title = $business->format($business->invoice_header, $pdf_title);

 ?>
 <?= GridView::widget([
 	'filterModel'	=> $searchModel,
 	'dataProvider'	=> $dataProvider,
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
 	'columns'		=> [
            ['class' => 'kartik\grid\SerialColumn'],
 			'name',
            'size',
 			[
                'attribute' => 'barcode',
                'width' => '100px',
            ],
            'openingStock',
            'totalPurchased:decimal:Total Recieved',
            'totalPurchaseReturn:decimal:Recive Returns',
            'totalSold',
            'returned:decimal:S/Returns',
            'stock:decimal:Current Stock',
 	  [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {view}'
            ],
 	],

 ]); 
 ?>