<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\init\models\Town */

$this->title = 'Create Town';
$this->params['breadcrumbs'][] = ['label' => 'Towns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="town-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
