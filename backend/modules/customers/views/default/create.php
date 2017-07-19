<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\customers\models\Customer */

$this->title = 'Create Customer';
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
