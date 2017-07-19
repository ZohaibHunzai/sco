<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\product\models\Product */

$this->title = 'Article Setup Form';
$this->params['breadcrumbs'][] = ['label' => 'Article', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

	<div class="row">
		<div class="col-md-12">
	    <?php echo $this->render('_form', [
	        'model' => $model,
	    ]) ?>
			
		</div>
	</div>


</div>
