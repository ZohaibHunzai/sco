<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\accounts\models\AccGroup */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Acc Group', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acc-group-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Acc Group'.' '. Html::encode($this->title) ?></h2>
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