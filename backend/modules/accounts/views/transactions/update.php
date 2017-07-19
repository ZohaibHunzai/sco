<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\accounts\models\Transaction */

$this->title = 'Update Transaction: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transaction-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
