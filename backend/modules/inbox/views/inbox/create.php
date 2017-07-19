<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\inbox\models\Thread */

$this->title = 'Create Thread';
$this->params['breadcrumbs'][] = ['label' => 'Threads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thread-create">

    <?php echo $this->render('_form', [
        'model' => $model,
        'mModel' => $mModel,
    ]) ?>

</div>
