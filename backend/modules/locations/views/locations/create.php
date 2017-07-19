<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\locations\models\Location */

$this->title = 'Create Location';
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
