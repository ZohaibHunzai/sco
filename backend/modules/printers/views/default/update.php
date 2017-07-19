<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\printers\models\Printer */

$this->title = 'Update Printer: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Printer', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="printer-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
