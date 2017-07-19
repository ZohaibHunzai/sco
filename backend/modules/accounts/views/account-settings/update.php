<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\accounts\models\AccountSetting */

$this->title = 'Update Account Setting: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Account Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="account-setting-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
