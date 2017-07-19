<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\dispacthe\models\Dispacthe */

$this->title = 'Create Dispacthe';
$this->params['breadcrumbs'][] = ['label' => 'Dispacthe', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dispacthe-create">

    <h1><?php // Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
