<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\init\models\BrandSector */

$this->title = 'Create Brand Sector';
$this->params['breadcrumbs'][] = ['label' => 'Brand Sectors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-sector-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
