<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\business\models\Business */

$this->title = 'Create Business';
$this->params['breadcrumbs'][] = ['label' => 'Business', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
