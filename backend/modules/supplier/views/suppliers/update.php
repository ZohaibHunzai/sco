<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\supplier\models\Supplier */

$this->title = 'Update Supplier: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="supplier-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
