<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\accounts\models\AccGroup */

$this->title = 'Update Acc Group: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Acc Group', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="acc-group-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
