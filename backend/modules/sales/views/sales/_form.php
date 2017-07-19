<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\modules\customers\models\Customer;
use backend\modules\payments\models\PaymentMethod;
use backend\modules\product\models\Product;
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use kartik\typeahead\Typeahead;

/* @var $this yii\web\View */
/* @var $model backend\modules\sales\models\Sale */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="sale-form">

		<?php $form = ActiveForm::begin(); ?>
		<?= $form->errorSummary($model); ?>
		
		<?= Html::hiddenInput("sale_id", $model->id, ['id' => 'sale_id']) ?>
		<?= Html::hiddenInput("add_item_url", Url::to(["/sales/sales/additem"]), ['id' => 'add_item_url']) ?>


		<!-- basic requiremtns -->
				<div class="row">
				 	<div class="col-sm-3">
								<?= $form->field($model, 'date')->widget(\kartik\widgets\DatePicker::classname(), [
										'options' => ['placeholder' => 'Choose Date'],
										'size' => 'xs',
										'type' => \kartik\widgets\DatePicker::TYPE_COMPONENT_APPEND,
										'pluginOptions' => [
												'autoclose' => true,
												'format' => 'dd-M-yyyy'
										]
								]); ?>
								
						</div>
						<div class="col-sm-3">
								<?= $form->field($model, 'payment_type')->dropDownList(asOptions(PaymentMethod::className()), ['prompt' => 'Select Payment Type']); ?>
						</div>

						<div class="col-md-3">
								<?php echo $form->field($model, 'customer_id')
								->widget(
										Select2::className(), 
										[
												'data' => asOptions(Customer::className(), 'id', 'name'),
												'options' => ['placeholder' => 'Select a Customer.'],
										]


								) ?>
						
						</div>
				</div>

				<div class="row">
						<div class="col-sm-12">
								<div class="select-product">
								
								
						
						</div>
					</div>
			</div>
		<hr />
		

		<!-- Total and products List -->
		<div class="row">
			<div class="col-md-7">
				<div class="pos">
					<?php
						echo $form->field($model, 'products')->widget(Typeahead::classname(), [
							'name' => 'product_id',
							'options' => ['placeholder' => 'Type name, code or SKU', 'id' => 'product-select'],

							//  'scrollable' => true,
							'pluginOptions' => ['highlight' => true],
							'dataset' => [
								[
									'remote' => [
										'url' => Url::to(['/sales/sales/products']).'?q=%ejjj',
										'wildcard' => '%ejjj',

									],

									'limit' => 600,
									'display' => 'value',
								],
							],
							'pluginEvents' => [
							'typeahead:selected' => "function(evt, item) {
									sale_id = $('#sale_id').prop('value');
									product = item.product;
									action = $('#add_item_url').prop('value');
									addItem(sale_id, product, action);

									$('#product-select').prop('value', '');
							}",
						],
						]);
				?>
				
					<table class="table table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>Product</th>
								<th>Price</th>
								<th>Qty</th>
								<th>Disc</th>
								<th>Total</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody class="products-body">
							
						</tbody>
					</table>	
				</div>
			</div>
			<div class="col-md-5">
				<div class="total">
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Total</legend>
						<div class="well">
							<h1>Rs: 5400</h1>
						</div>
						<div class="discount form-group">
							<label>Discount</label>
							<input type="text" name="" checked="form-control" placeholder="Discount">
						</div>
					</fieldset>
				</div>
			</div>

		</div>

		
		<div class="form-group">
				<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Sale Now', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

</div>

<input type="hidden" id='total_items' value = '0' name="">
<script type="text/javascript">
function addItem(sale_id, product, action){
	
	total_items = parseInt($('#total_items').prop('value'));

	
	container = $('.products-body');


	container.append(
		
		// create row
		$($(document.createElement('tr')).attr({
			class: 'item-row product-' + product.id,
			
		})

		.append($(document.createElement('td')).attr({
			'class': 'numeric',
			
		}).text(total_items + 1))

		.append($(document.createElement('td')).attr({
			'class': 'item-name',
			
		}).append(
			"<input type='hidden' name='ProductItem[product_id]["+ total_items + "]' value  = '" + product.id + "'>",
			product.name

		))
		.append($(document.createElement('td')).attr({
			'class': 'item-price',
			
		}).text(product.price.selling_price))

		.append($(document.createElement('td')).attr({
			'class': 'item-qty',
			'style' : 'width: 15%',
			
		}).append(
			"<input type='text' name='ProductItem[qty][" + total_items + "]' value='1' />"
		))

		.append($(document.createElement('td')).attr({
			'class': 'item-name',
			'style' : 'width: 15%',
			
		}).append(
		"<input type='text' name='ProductItem[discount][" + total_items + "]' value='1' />"
		))


		.append($(document.createElement('td')).attr({
			'class': 'item-name',
			
		}).text(2000))

		.append(
				$(document.createElement('td')).attr({
				'class': 'item-name',
			
				})
				.append(
					$(document.createElement('a')).attr({
						'class': 'delete-btn',
						'data-row' : 'the-row' + product.id,
						'href' : '#'
					}).text('Delete')
				)
		)








	)
)


	$("#total_items").prop("value", ++total_items);
}
</script>

