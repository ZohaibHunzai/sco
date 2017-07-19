<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\cash\models\CashCollection */

$this->title = 'Update Cash Collection: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cash Collections', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cash-collection-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
