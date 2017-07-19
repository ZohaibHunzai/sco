<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\dispacthe\models\Dispacthe */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dispacthe', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dispacthe-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Dispacthe'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'hidden' => true],
        'store_id',
        'type',
        'status',
        'comments',
        'date',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>