<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use backend\modules\sales\models\Sale;
use kartik\grid\GridView;
use backend\modules\business\models\Business;

$this->title = "Brand Wise Sales Report";


$business = Business::find()->one();

$pdf_title = "
    <div style='text-align:center'>
        <p style='text-align:center'>Sales Report for a Month of {$month} " . date('Y') . "</p>
    </div>
";
$file_name = time() . "-" . ' brand wise sales report';

$pdf_title = $business->format($business->invoice_header, $pdf_title);

?>

<div class="daily-sales">
	<?php 
		echo GridView::widget([
			'dataProvider' => $data,
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
	            'label' => 'Export',
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
        		[
        			'attribute' => 'name',
        			// 'format' => 'date',
        			'pageSummary' => 'Total Sales In This Month',
        		],
        		[
        			'attribute' => 'total_products',
        			// 'format' => 'date',
        			'pageSummary' => true,
        		],

        		[
        			'attribute' => 'total_sale',
        			'format' => 'decimal',
        			'pageSummary' => true,
        		],
        		[
        			'attribute' => 'sales_return',
        			'format' => 'decimal',
        			'pageSummary' => true,
        		],

        		[
        			// 'class' => 'backend\components\TotalColumn',
        			// 'attribute' => 'total_sale',
        			'label' => 'Balance',
        			'filter' => false,
        			'format' => 'decimal',
        			'value' => function($m){
        				if ( $m )
        					return $m['total_sale'] && $m['sales_return'] ? 
        						$m['total_sale'] - $m['sales_return'] : 0;
        				return 0;
        			},
        			'pageSummary' => false
        		]

        		// 'total_sale:decimal',

			]
		]);

	?>
</div>
