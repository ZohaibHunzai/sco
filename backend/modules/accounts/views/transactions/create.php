<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\accounts\models\Transaction */

$this->title = 'Create Transaction';
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-create">
    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
