<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\accounts\models\PrimaryAccount */

$this->title = 'Create Primary Account';
$this->params['breadcrumbs'][] = ['label' => 'Primary Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="primary-account-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
