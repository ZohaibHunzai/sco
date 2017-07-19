<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\init\models\Unit */

$this->title = 'Create Unit';
$this->params['breadcrumbs'][] = ['label' => 'Unit', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unit-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
