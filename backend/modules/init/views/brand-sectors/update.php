<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\init\models\BrandSector */

$this->title = 'Update Brand Sector: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Brand Sectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="brand-sector-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
