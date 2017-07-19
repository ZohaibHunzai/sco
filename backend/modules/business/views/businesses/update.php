<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\business\models\Business */

$this->title = 'Update Business: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Business', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="business-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
