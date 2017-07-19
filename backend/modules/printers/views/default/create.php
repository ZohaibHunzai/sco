<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\printers\models\Printer */

$this->title = 'Create Printer';
$this->params['breadcrumbs'][] = ['label' => 'Printer', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="printer-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
