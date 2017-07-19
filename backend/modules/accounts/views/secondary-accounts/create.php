<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\accounts\models\SecondaryAccount */

$this->title = 'Create Secondary Account';
$this->params['breadcrumbs'][] = ['label' => 'Secondary Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="secondary-account-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
