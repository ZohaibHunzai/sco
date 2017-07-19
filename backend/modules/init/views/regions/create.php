<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\init\models\Region */

$this->title = 'Create Region';
$this->params['breadcrumbs'][] = ['label' => 'Region', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
