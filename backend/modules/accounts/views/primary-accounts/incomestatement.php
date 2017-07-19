<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Income Statement';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
          'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => 'Income Statement',
        ],
        'export' => [
            'target' => GridView::TARGET_BLANK,
            'showConfirmAlert' => false,
        ],
        'exportConfig' => [

            'pdf' => [
                'filename' => ''.date('D-M-Y').'/Income Statement Information ' . time(),
                'config' => [
                    'contentBefore' => null,
                    'methods' => [
                        'setHeader' => [
                            [
                                'odd' => [
                                    'L' => [
                                        'content' => '<h5>Report Generated on:</h5>' . date('D, d-Y g:i a'),
                                        'font-size' => 6,
                                        'color' => '#333',
                                    ],
                                    'C' => [
                                        'content' => '<h4> Punar </h4></br><h5>Month: '.date('M:Y').' Income Statement</h5>',
                                        'font-size' => 12,
                                        'color' => '#333',
                                        'text-align'=>'center',
                                        'padding-bottom'=> '2px'
                                    ],

                                    'R' => [
                                        'content' => 'By: ' . Yii::$app->user->identity->username,
                                        'font-size' => 8,
                                        'color' => '#333'
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
                                        'color' => '#333',
                                    ]
                                ]
                            ]
                        ]

                    ]
                ]
            ],
            GridView::EXCEL => [],
            GridView::HTML => [],
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [
            'attribute'     => 'account_id',
            'label'         => 'Income Account Title',
            'value'         => function($model)
            {
                if ($model->primary_account_id == 8) {

                    return $model->name;
                     
                    }
            }
            ],
            [
            'label'  => 'Amount',
            'value' => function($model)
            {
            	if ( $model->primary_account_id == 8) {
            		return abs($model->balance);
         			
            	}
            	// else{
            	// 	return null;
            	// }
            },
           	'pageSummary' => true
            ],
            [
            'attribute'     => 'account_id',
            'label'         => 'Expense Account Title',
            'value'         => function($model)
            {
                if ($model->primary_account_id == 11) {

                    return $model->name;
                     
                    }
            }
            ],
            [
            'label'  => 'Amount',
            'value' => function($model)
            {
            	if ( $model->primary_account_id == 11) {
            		return abs($model->balance);
            	}
            	// else{
            	// 	return null;
            	// }
            },
           	'pageSummary' => true

            ],


            // ['class' => 'yii\grid\ActionColumn'],
        ],
           	'showPageSummary' => true,

    ]); ?>


</div>
