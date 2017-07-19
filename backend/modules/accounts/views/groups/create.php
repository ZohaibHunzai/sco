<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\accounts\models\AccGroup */

$this->title = 'Create Acc Group';
$this->params['breadcrumbs'][] = ['label' => 'Acc Group', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acc-group-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
