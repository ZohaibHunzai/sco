<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\inventory\models\Inventory */

$this->title = 'Create Inventory';
$this->params['breadcrumbs'][] = ['label' => 'Inventories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-create">
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
		
	</div>
    

</div>
