<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\price\models\Price */

$this->title = 'Update Price: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="price-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
