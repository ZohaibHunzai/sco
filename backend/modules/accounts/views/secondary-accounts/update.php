<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\accounts\models\SecondaryAccount */

$this->title = 'Update Secondary Account: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Secondary Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="secondary-account-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
