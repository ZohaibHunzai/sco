<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\purchases\models\Purchase */

$this->title = 'Update Recieve Inventory: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Recieve Inventory', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="purchase-update">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
