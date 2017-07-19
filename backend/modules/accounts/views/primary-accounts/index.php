<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\Constants;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\accounts\models\PrimaryAccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Primary Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="primary-account-index">


    <p>
        <?= Html::a('Create Primary Account', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete All', ['delete-all'], ['class' => 'btn btn-default']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'code',
            'balance',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return Constants::statusText($model->status);
                }
            ],
            // 'created_by',
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
