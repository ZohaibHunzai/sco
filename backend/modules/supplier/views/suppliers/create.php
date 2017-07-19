<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\supplier\models\Supplier */

$this->title = 'Create Supplier';
$this->params['breadcrumbs'][] = ['label' => 'Suppliers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
