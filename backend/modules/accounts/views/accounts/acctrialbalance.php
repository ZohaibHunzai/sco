<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts Trial Balance';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

   
    


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'showPageSummary' => true,
        'panel' => [
            'type' => GridView::TYPE_INFO,
            'heading' => 'Accounts Trial Balance',
        ],
        'export' => [
            'target' => GridView::TARGET_BLANK,
            'showConfirmAlert' => false,
        ],
        'exportConfig' => [

            'pdf' => [
                'filename' => ''.date('D-M-Y').'/Account Trial Balacnce Information ' . time(),
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
                                        'content' => '<h4> Punar </h4></br><h5>Account Trial Balance</h5>',
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
            	if ($model->primaryAccount->id == 7 || $model->primaryAccount->id == 11) {
            		return ($model->balance );
         			
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
            	if ($model->primaryAccount->id == 8 || $model->primaryAccount->id == 9 || $model->primaryAccount->id == 10) {
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
