<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use \common\Constants;
use \backend\modules\accounts\models\PrimaryAccount;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\accounts\models\SecondaryAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Secondary Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="secondary-account-index">

    
    <p>
        <?= Html::a('Create Secondary Account', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showPageSummary' => true,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'filter' => false,
            ],
            'name',
            'code',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return Constants::statusText($model->status);
                },
                'width' => '120px'
            ],
            [
                'attribute' => 'primary_account_id',
                'value' => 'primaryAccount.name',
                'label' => 'Account Head',
                'filter' => asOptions(PrimaryAccount::className(), 'id', 'name')
            ],
            [
                'attribute' => 'balance',
                // 'pageSummary' => true,
            ],

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>

</div>
