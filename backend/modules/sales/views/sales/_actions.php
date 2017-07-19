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
use  backend\modules\payments\models\Payment;
?>
<div class="pos-actions">
		<div class="row">
			<div class="col-md-3">
				<?php echo $form->field($model, 'customer_id', ['template' => '{input}'])
				->widget(
						Select2::className(), 
						[
								'data' => C::asSalesOptions(),
								'options' => ['placeholder' => 'Select a Customer.'],
						]


				) ?>
			</div>
			<div class="col-sm-2 ">
				<?= 
				 $form->field($model, 'date', ['template' => '{input}'])->textInput(['value'=>date('Y-m-d'), 'disabled' => true]); 
				 ?>
			</div>
			<div class="col-sm-2 ">
				
			</div>

			<div class="col-sm-2 hidden ">
					<?= $form->field($model, 'payment_type', ['template' => '{input}'])->dropDownList(Payment::getPaymentTypes()); ?>
			</div>
			<div class="col-sm-2 hidden">
					<?= $form->field($model, 'sales_person_id', ['template' => '{input}'])->textInput(['value'=>Yii::$app->user->identity->id]); ?>
			</div>

			<div class="col-md-3 pull-right">
				<div class="new-sale text-right">
					<div class="btn-group">
						<?= Html::a("New Sale", Url::to(), ['class' => 'btn btn-flat btn-primary']) ?>
						<?= Html::a("Sale Return", Url::to('return'), ['class' => 'btn btn-flat btn-success']) ?>
						<?= Html::a("Cancel Sale", Url::to(), ['class' => 'btn btn-flat btn-danger']) ?>
						
					</div>
				</div>
			</div>

		</div>
	</div>
</div>