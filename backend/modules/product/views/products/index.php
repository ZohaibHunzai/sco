<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use backend\modules\business\models\Business;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\product\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;

$business = Business::find()->one();

$pdf_title = "
    <div style='text-align:center'>
        <p style='text-align:center'>Product List</p>
    </div>
";
$file_name = time() . "-" . ' product-report';

$pdf_title = $business->format($business->invoice_header, $pdf_title);

?>
<div class="product-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Define New Article', ['create'], ['class' => 'btn btn-flat btn-default']) ?>
        <?php echo Html::a('Reset Search', ['index'], ['class' => 'btn btn-flat btn-default']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
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
        'showPageSummary' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'name',
                'width' => '120px',
            ],
           
            // 'is_parent',
            [
                'label' => 'KG',
                'value' => function($model) {
                    // $m =  $model->getChild()->count("*");
                    $m = '';
                    foreach ($model->child as $key => $value) {
                        $m .= $value->size . ", ";
                    }

                    return rtrim($m, ", ");

                }
            ],
            // 'parent',
            [
                'attribute' =>  'barcode',
                'width' => '100px',

            ],
            [
                'attribute' => 'category_id',
                'label'     => 'Category',
                'filter' => false,
                'width' => '100px',
                'value'     =>function($model)
                {
                    return $model->category->name;
                },
                'filter' => asOptions("backend\modules\categories\models\Category"),
            ],
            [
                'attribute' => 'brand_id',
                'value' => 'brand.name',
                'label' => "Brand",
                'width' => '100px',
                'filter' => asOptions("backend\modules\init\models\Brand"),
            ],
            [
                'attribute' => 'brand_sector_id',
                'value' => 'brandSector.name',
                'label' => "B/Sector",
                'width' => '110px',
                'filter' => asOptions("backend\modules\init\models\BrandSector"),
            ],

            'price.selling_price:decimal:Price',
            [
                'attribute' => 'childSales',
                'pageSummary' => true,
                'label' => 'Sales',
                'format' => 'decimal',
            ],
            [
                'attribute' => 'stockx',
                'label' => 'stock',
                'pageSummary' => true,
                'format' => 'decimal',
            ],
            
            [
                'attribute' => 'worth',
                'label' => 'Worth',
                'format' => 'decimal',
                'pageSummary' => true,
            ],
            [
                'class'=>'kartik\grid\ExpandRowColumn',
                'width'=>'50px',
                'label' => 'Sizes Detail',
                'value'=>function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                // 'detail'=>function ($model, $key, $index, $column) {
                //     return Yii::$app->controller->renderPartial('_size-details', ['model'=>$model]);
                // },
                'detailUrl' => Url::to(['/products/products/detail']),
                'headerOptions'=>['class'=>'kartik-sheet-style'] ,
                'expandOneOnly'=>true
            ],
            [
                'label' => 'Actions',
                'value' => function($model) {
                    $str = "<div>";
                    $str .= Html::a("Add Inventory", ['/inventory/inventory/create', 'product_id' => $model->id], ['class' => 'btn btn-default btn-flat']);

                    return $str;
                },
                'format' => 'raw',
                'visible' => false,
            ],
            // 'image_id',
            // 'unit',
            // 'price_id',

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{view} {update} ',
                'buttons' => [
                    'my_button' => function ($url, $model, $key) {
                        return Html::a('<i class="fa fa-plus"></i>', ['duplicate', 'id'=>$model->id], [
                            'data-toggle' => 'tooltip',
                            'title' => 'Duplicate Article',
                        ]);
                    },
                ]
            ],
        ],
    ]); ?>

</div>
