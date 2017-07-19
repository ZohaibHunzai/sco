<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use backend\modules\business\models\Business as B;

/* @var $this yii\web\View */
/* @var $model backend\modules\dispacthe\models\Dispacthe */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dispacthe', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// ------------------------------------

$business = B::find()->one();

$pdf_title = "
    <div style='text-align:center'>
        <p style='text-align:center'>Dispacth List</p>
    </div>
";
$file_name = time() . "-" . ' dispacth-list';

$pdf_title = $business->format($business->invoice_header, $pdf_title);


// --------------------------------------


?>


<div class="dispacthe-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Dispacthe'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
                        
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        [
            'attribute' => 'store_id',
            'label'     => 'Store Name',
            'value'     => $model->stores->name,
        ],
        'type',
        'status',
        'comments',
        'date',
    ];
    // echo DetailView::widget([
    //     'model' => $model,
    //     'attributes' => $gridColumn
    // ]); 
?>
        <fieldset class="scheduler-border">
        <legend class="scheduler-border">Dispacth Information</legend>
        
            <div class="col-md-4">
                <label> <b> Store Name : </b></label>
                <label><?php echo $model->stores->name; ?></label>
            </div>
            <div class="col-md-4">
                <b><label>  Type: </label></b>
                <label style="text-align: center; border: 1px;"><?php echo $model->type; ?></label>
            </div>
            <div class="col-md-4">
                <label> <b> Comments : </b></label>
                <label style="text-align: center;"><?php echo $model->comments; ?></label>
            </div>
        </fieldset>

        <fieldset class="scheduler-border">
        <legend class="scheduler-border">Dispatch Items Information</legend>
         
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'showPageSummary' => true,
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
                    'products.name',
                    [
                        'attribute'     => 'products.price.purchase_price',
                        'pageSummary'   => true
                    ],
                    [   'attribute'     => 'products.price.selling_price',
                        'pageSummary'   =>true
                    ],
                    [
                        'attribute'     => 'quantity',
                        'pageSummary'   => true
                    ],
                    [
                        'label'         => 'status',
                    ],
                    [
                        // 'attribute'     => ''
                        'label'         => 'Total',
                        'value'         => function($model)
                                    {
                                        return $model->quantity * $model->products->price->selling_price;               
                                     },
                        'pageSummary'   => true
                    ],
                ],
                    
                // 'pjax' => true,
                // 'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
                'panel' => [
                    'type' => GridView::TYPE_INFO,
                    'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
                ],
                // set a label for default menu
                'export' => [
                    'label' => 'Page',
                    'fontAwesome' => true,
                ],
            ]); ?>   
         
        </fieldset>

    </div>
</div>