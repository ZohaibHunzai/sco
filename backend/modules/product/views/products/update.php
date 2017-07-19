<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\Product */

$this->title = 'Update Article: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Article', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
