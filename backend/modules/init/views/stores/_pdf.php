<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\init\models\Store */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Store', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Store'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'name',
        'code',
        'status',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>