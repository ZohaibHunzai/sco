<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use backend\modules\accounts\models\AccGroup as AG;
use yii\bootstrap\ActiveForm;

use backend\modules\accounts\models\Account;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\accounts\models\AccGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Assign Accounts to  Group ' . $group->name;

$this->params['breadcrumbs'][] = ['url' => ['/accounts/accounts/index'], 'label' => 'Accounts'];
$this->params['breadcrumbs'][] = ['url' => ['/accounts/groups/index'], 'label' => 'Groups'];
$this->params['breadcrumbs'][] = "Assign Accounts";

?>

<div class="assign-accounts">

    <?php $form = ActiveForm::begin([
    	// 'layout' => isset($inline) ? 'inline' : 'horizontal',
    	// 'action' => ['/accounts/groups/create']
    ]); ?>

    <div class="row">
    	<div class="col-md-12">
    		<!-- Filter Dropdown -->
             <?= 
	            Select2::widget([
	                'name' => 'account_selector',
	                'data' => asOptions(Account::className(), 'id', 'name'),
	                'options' => [
	                	'prompt' => 'Choose an Account.',
	                	'class' => 'account-chooser',
	                	'data-url' => Url::to(['/accounts/accounts/account-json'])
	                ]
	            ]);
           ?>

            <?php echo $form->field($group, 'id', ['template' => '{input}'])->hiddenInput(['value' => $group->id, 'id' => 'assigned_group_id']); ?>
        </div>



    	<div class="col-md-12">
    		<hr>

    		<div id="assigned-selected-accounts" data-default-url="<?= Url::to(['/accounts/groups/assigned-accounts', 'id' => $group->id]) ?>" >
    			
    		</div>
    	</div>

    </div>


    <div class="row">
    	<div class="col-md-12">
    		<hr />
    		<?= Html::submitButton("Submit Values", ['class' => 'btn btn-default btn-block']) ?>
    	</div>
    </div>


    <?php ActiveForm::end() ?>
</div>