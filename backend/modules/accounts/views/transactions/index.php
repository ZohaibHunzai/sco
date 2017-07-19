<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use \backend\modules\accounts\models\Transaction;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\accounts\models\search\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary'=>true,
        'panel' => true,
        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> '. $this->title .'</h3>',
            'type'=>'info',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Transaction', ['create'], ['class' => 'btn btn-default']),
            'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
            // 'footer'=>true
        ],
        'toolbar' => [
            // [
            //     'content'=>
            //         Html::button('<i class="glyphicon glyphicon-plus"></i>', [
            //             'type'=>'button', 
            //             'title'=>Yii::t('kvgrid', 'Add Book'), 
            //             'class'=>'btn btn-success'
            //         ]) . ' '.
            //         Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['grid-demo'], [
            //             'class' => 'btn btn-default', 
            //             'title' => Yii::t('kvgrid', 'Reset Grid')
            //         ]),
            // ],
            '{export}',
            '{toggleData}'
        ],
        'columns' => [
            // ['class' => 'kartik\grid\SerialColumn'],
            [
                'attribute' => 'group',
                'width' => '60px'
            ],
            [
                'attribute' => 'created_at',
                'filter' => false,
                'value' => function($model){
                    return date("M d, Y", strtotime($model->created_at));
                },
                'label' => 'Date',
            ],
            // 'name',
            [
                'attribute' => 'account_id',
                'value' => function($model) {
                    $str = $model->type == Transaction::DBT ? $model->account->name : " &nbsp; &nbsp; To " . $model->account->name;

                    return $str;
                },
                'label' => 'Account',
                'format' => 'raw',
            ],
            [
                'attribute' => 'narration',
                // 'width' => '200px',
            ],
            [
                'attribute' => 'amount',
                'value' => function ($model)
                {
                    return $model->type == Transaction::DBT ? $model->amount : null;
                },
                'format' => 'decimal',
                'label' => 'Debit',
                'pageSummary' => true,


            ],

            [
                'attribute' => 'amount',
                'value' => function ($model)
                {
                    return $model->type !== Transaction::DBT ? $model->amount : null;
                },
                'format' => 'decimal',
                'label' => 'Credit',
                'pageSummary' => true,

            ],


            // 'status',
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',
            // 'deleted_at',
            // 'deleted_by',
            // 'mode',
            // 'type',
            // 'approved_by',
            // 'approved_at',
            // 'group',
            // 'branch_id',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>

</div>
