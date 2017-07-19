<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\purchases\models\Purchase */

$this->title = $model->is_return == 1 ? 'Return Inventory' : 'Recieve Inventory';
$this->params['breadcrumbs'][] = ['label' => 'Purchase', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="purchase-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
