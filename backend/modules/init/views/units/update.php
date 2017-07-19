<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\init\models\Unit */

$this->title = 'Update Unit: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Unit', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unit-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
