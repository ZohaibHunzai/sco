<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trial Balance';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

   
    


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showPageSummary' => true,
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => 'Secondry Trial Balance',
        ],
        'export' => [
            'target' => GridView::TARGET_BLANK,
            'showConfirmAlert' => false,
        ],
        'exportConfig' => [

            'pdf' => [
                'filename' => ''.date('D-M-Y').'/Secondry Trial Balacnce Information ' . time(),
                'config' => [
                    'contentBefore' => null,
                    'methods' => [
                        'setHeader' => [
                            [
                                'odd' => [
                                    'L' => [
                                        'content' => '<h5>Report Generated on:</h5>' . date('D, d-M-Y g:i a'),
                                        'font-size' => 6,
                                        'color' => '#333',
                                    ],
                                    'C' => [
                                        'content' => '<h4> Punar </h4></br><h5>Trail Balance</h5>',
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
                'label'         => 'Account Title',
                'value'         => function($model)
                                    {
                                        return $model->name;
                                    }
            ],
            [
            'label'  => 'Debit',
            'value' => function($model)
            {
            	if ($model->primary_account_id == 7 || $model->primary_account_id == 11) {
            		return abs($model->balance );
         			
            	}
            	else{
            		return null;
            	}
            },
           	'pageSummary' => true,
            'format' => 'decimal',
            ],
            [
            'label'  => 'Credit',
            'value' => function($model)
            {
            	if ($model->primary_account_id == 8 || $model->primary_account_id == 9 || $model->primary_account_id == 10) {
            		return $model->balance;
            	}
            	else{
            		return null;
            	}
            },
           	'pageSummary' => true,
            'format' => 'decimal',

            ],


            // ['class' => 'yii\grid\ActionColumn'],
        ],
           	'showPageSummary' => true,

    ]); ?>


</div>
