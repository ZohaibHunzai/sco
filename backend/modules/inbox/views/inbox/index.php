<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\inbox\models\ThreadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Threads';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thread-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a('Create Thread', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'created_by',
            [
                'attribute' => 'created_by',
                'value' => 'createdBy.username',
            ],
            [
                'attribute' => 'created_for',
                'value' => function($model){
                    return $model->createdFor->username;
                },
            ],

            // 'updated_by',
            [
                'attribute' => 'created_at',
                'format' => 'relativeTime',
            ],
            // 'updated_at',
            // 'deleted_by',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
