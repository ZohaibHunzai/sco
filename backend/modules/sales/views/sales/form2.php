<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\modules\customers\models\Customer as C;
use backend\modules\payments\models\PaymentMethod;
use backend\modules\product\models\Product;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use kartik\typeahead\Typeahead;
?>
<div class="pos-wrapper">
	<div class="container-fluid">
			<div class="row">
				<!-- <div class="col-md-4">
					<?php //$this->render("_products", ['products' => $products]) ?>
					
				</div> -->
				<div class="col-md-12">
					<div class="pos-interface-outer">
						<?php $form = ActiveForm::begin() ?>
							<div class="pos-interface">
								<div class="row">
									<div class="col-md-12">
										<?= $this->render("_actions", [
											'model' => $model,
											'form' => $form
										]) ?>
									</div>
									<div class="col-md-7">
										<?= $this->render("_pos", [
											'model' => $model,
											// 'products' => $products,
											'form' => $form,
										]); ?>
										
									</div>
									<div class="col-md-5">
										<?= $this->render("_totals", [
											'model' => $model,
											// 'products' => $products,
											'form' => $form,
										]) ?>
									</div>
								</div>
							</div>
						<?php ActiveForm::end() ?>

					</div>
				</div>

				


			</div>
	</div>
</div>