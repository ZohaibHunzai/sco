<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\cash\models\CashCollection */

$this->title = 'Create Cash Collection';
$this->params['breadcrumbs'][] = ['label' => 'Cash Collections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cash-collection-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
