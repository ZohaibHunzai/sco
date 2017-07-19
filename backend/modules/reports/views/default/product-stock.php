<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use backend\modules\sales\models\Sale;
use kartik\grid\GridView;
use backend\modules\business\models\Business;

$this->title = "Product Wise Stock Report";


$business = Business::find()->one();

$pdf_title = "
    <div style='text-align:center'>
        <p style='text-align:center'>Product Wise Stock Report</p>
    </div>
";
$file_name = time() . "-" . ' daily sales report';

$pdf_title = $business->format($business->invoice_header, $pdf_title);

?>

<div class="daily-sales">
	<?php 
		echo GridView::widget([
			'dataProvider' => $data,
			'filterModel' => $searchModel,
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
        			'filter' => true,
        			'width' => '140px',
        			// 'format' => 'string',
        			// 'pageSummary' => 'Total Sales In This Month',
        		],
        		
        		[
        			'attribute' => 'brand_name',
        			// 'format' => 'string',
        			'pageSummary' => 'Total',
        			'filter' => $brands,
        			'width' => '120px',
        		],
                [
                    'attribute' => 'brand_sector',
                    // 'format' => 'string',
                    // 'pageSummary' => '',
                    'filter' => $b_sectors,
                    // 'value' => 'brands.name',
                    'width' => '120px',
                ],


        		[
        			'attribute' => 'selling_price',
        			'format' => 'decimal',
        			'pageSummary' => true,
        			'label' => 'Price',
        		],

        		[
        			'attribute' => 'total_purhcased',
        			'format' => 'decimal',
        			'pageSummary' => true,
        			'label' => 'Recived',
        		],

        		[
        			'attribute' => 'purhcase_return',
        			'format' => 'decimal',
        			'pageSummary' => true,
        			'label' => 'HO Dispatch'
        		],
        		[
        			'attribute' => 'dispatches_received',
        			'format' => 'decimal',
        			'pageSummary' => true,
        			'label' => 'D/Recived',
        		],
        		
        		[
        			'attribute' => 'dispatches_sent',
        			'format' => 'decimal',
        			'pageSummary' => true,
        			'label' => 'D/Sent'
        		],

        		[
        			'attribute' => 'total_sold',
        			'format' => 'decimal',
        			'pageSummary' => true,
        			'label' => 'Sold',
        		],
        		[
        			'attribute' => 'sale_return',
        			'format' => 'decimal',
        			'pageSummary' => true,
        			'label'=> 'Sales/R '
        		],

        		[
        			'label' => 'Stock',
        			'value' => function($model) {
        				return $model['total_purhcased'] + $model['dispatches_received'] + $model['sale_return']
        					- $model['purhcase_return'] - $model['total_sold'] - $model['dispatches_sent'];
        			},
        			'format' => 'decimal',
        			'pageSummary' => true,
        		],

        		[
        			'label' => 'Worth',
        			'value' => function($model) {
        				return $model['selling_price'] * ($model['total_purhcased'] + $model['dispatches_received'] + $model['sale_return']
        					- $model['purhcase_return'] - $model['total_sold'] - $model['dispatches_sent']);
        			},
        			'format' => 'decimal',
        			'pageSummary' => true,
        		],
        		
        		// [
        		// 	'class' => 'backend\components\TotalColumn',
        		// 	'attribute' => 'total_sale',
        		// 	'label' => 'Growth',
        		// 	'filter' => false,
        		// 	'format' => 'decimal',
        		// ]

        		// 'total_sale:decimal',

			]
		]);

	?>
</div>
