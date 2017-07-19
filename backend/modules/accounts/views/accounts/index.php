<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use common\Constants;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\accounts\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
   
    <p>
        <?= Html::a('Create Account', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'name',
                'value' => function($model){
                    return Html::a($model->name, ['/accounts/transactions/ledger', 'account_id' => $model->id]);
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return Constants::statusText($model->status);
                }
            ],

            [
                'attribute' => 'secondary_account_id',
                'label' => 'GL',
                'value' => 'nameTree',
            ],
            'code',
            [
                'attribute' => 'balance',
                'format' => 'decimal',
            ],
            // 'is_system_account',
            // [
            //     'attribute' => 'created_by',
            //     'value' => function ($model)
            //     {
            //         return ucwords($model->createdBy->publicIdentity);
            //     }
            // ],
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>

</div>
