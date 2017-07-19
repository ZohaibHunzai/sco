<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\customers\models\Customer */

$this->title = 'Update Customer: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
