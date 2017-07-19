<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\accounts\models\AccountSetting */

$this->title = 'Create Account Setting';
$this->params['breadcrumbs'][] = ['label' => 'Account Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-setting-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
