<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\expenses\models\Expense */

$this->title = 'Update Expense';
$this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="expense-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
