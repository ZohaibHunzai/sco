<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\inbox\models\Thread */

$this->title = 'Update Thread: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Threads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="thread-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
