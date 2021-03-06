<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\locations\models\Location */

$this->title = 'Update Location: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="location-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
