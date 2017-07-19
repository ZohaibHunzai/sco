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
?>

<div class="pos-outer">
	<div class="main-pos">
		<div class="input">
			<?php
				echo $form->field($model, 'products', ['template' => '{input}'])->widget(Typeahead::classname(), [
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
							// if(item.stock == '0' || item.stock <= 0) {
							// 	alert(item.product.name  + ' is Out of stock ');
							// 	return;
							// }

							sale_id = $('#sale_id').prop('value');
							product = item.product;
							action = $('#add_item_url').prop('value');
							addItem(sale_id, product, action);

							setTimeout(function(){
								$('#product-select').prop('value', '');
							}, 10)
					}",
				],
				]);
			?>
		</div>
		<div class="pos-items">
			<table class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Product</th>
								<th>Price</th>
								<th width="12%">Qty</th>
								<th width="10%">Disc</th>
								<th width="14%">Total</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody class="products-body">
							
						</tbody>
					</table>		
		</div>
	</div>
</div>

<?php 
$this->registerJs("
	$(document).ready(function () {
		$(document).keydown(function(e) {
	        if (e.keyCode == 32 && e.ctrlKey) {
	            // alert('ctrl A');
	            e.preventDefault();

	            $('#sale-cash').focus()
	            if ( $('#sale-cash').val() == '0') {
	            	$('#sale-cash').prop('value', '');
	            }
	        }
	    });

	    $('#sale-cash').on('blur', function(){
	    	if($(this).val() == '') {
	    		$(this).val('0');
	    	}
	    })
	});
");
?>
<script type="text/javascript">



// pos class
var Pos = {
	products: [],
	items_ids: [],
	dom_items: [],
	total: 0,
	discount: 0,
	tax: 0,
	grand_discount: 0,
	grand_total: 0,
	cash: 0,
	cash_change: 0,
	grand_tonnage: 0,

	change: function(event, product_id, type){
		
		if(type == '1') {
			var new_qty = parseInt($(event).val());
			this.dom_items[product_id].qty = new_qty;
		
		}

		if(type == '2') {

			var new_discount = parseInt($(event).val());
			this.dom_items[product_id].discount = new_discount;

		}
		
		this.refresh();


	},

	changePrice: function(event, product_id) {

		value = Number($(event).val()).toFixed(2);$(event).val()
		this.dom_items[product_id].price = value;
		this.refresh();
	},
	
	setGrandDiscount: function(elem) {
		if(this.total > parseFloat(elem.value)	) {
			this.grand_discount = parseFloat(elem.value);
		} else{
			alert("You can't give discount more than net total.");
			// return false;
		}


		this.refresh();
	},

	addItem: function(product) {
		product_id = product.id
		this.addDomItem(product);
		if(!this.exists(product_id)) {
			
			this.products[product_id] = product;
			this.items_ids.push(product_id);

		}

		this.refresh();
		
	},

	refresh: function(){
		this.calculate();
		this.render();
		this.totals();
		this.cashChange();
	},
	cashChange: function(){
		this.cash = parseFloat($("#sale-cash").prop('value'));
		this.cash_change = this.cash - this.grand_total;
		if(this.cash != 0) {
			$('.change').text(this.cash_change);
			$('.hidden_change').prop('value', this.cash_change);
		} else {
			$('.change').text(0.0);
			$('.hidden_change').prop('value', 0.0);

		}
		return true;
	},
	/**
	 * Checks whether product exists
	 * @param  {integer} id
	 * @return {booelan} 
	 */
	exists: function(id) {
		for(i = 0; i < this.items_ids.length; i++) {
			if(this.items_ids[i] == parseInt(id)) {
				return true;
			}

		}
		return false;
	},

	addDomItem: function(product){
		obj = {
			product: product,
			qty: 1,
			discount: 0.0,
			price: product.price.selling_price,
			total: 0.0,
			name: product.value,
			tonnage: 0,
		};

		if(this.exists(product.id)) {
			// product exists already
			this.dom_items[product.id].qty = this.dom_items[product.id].qty + 1;
		} else {
			this.dom_items[product.id] = obj;
		}
	},

	calculate: function(){

		// calculate prices
		var net_total = 0;
		var net_discount = 0;
		var total_tonnage = 0;

		for(var product_id in this.dom_items) {
			// console.log(product_id);
			product 			= 	this.dom_items[product_id];
			price 				= 	product.price;
			qty 					= 	product.qty;
			discount 			= 	product.discount;
			net_discount 	+=	discount;
			total 				= 	( price * qty ) - discount;
			// tonnage 			=		Number((parseFloat(product.product.total_weight) * parseFloat(product.qty)) / parseFloat(product.product.unit.tonnage_unit)).toFixed(3);
			// console.log(product.product.unit.tonnage_unit);

			this.dom_items[product_id].total = total;
			// this.dom_items[product_id].tonnage = tonnage;
			net_total 		+= 	total;
			// total_tonnage += parseFloat(tonnage);

		}

		this.total 			=	net_total
		this.discount  	=	net_discount;
		this.grand_total = this.total - this.grand_discount;

		// statistics
		this.total_items 		=		this.dom_items.length;
		// this.grand_tonnage 	= 	parseFloat(total_tonnage);

		// console.log("Total Items: " + this.total_items + ". \n Net Total: " + this.total)
	},
	
	/**
	 * Delete item
	 */
	delete: function(id){
		// console.log(id);
		this.dom_items.splice(id, 1);
		this.items_ids.splice(this.items_ids.indexOf(id), 1);
		// console.dom_items()
		this.refresh();
	},
	/**
	 * Renders the UI to the screen
	 * Maps to DOmElement array inside the object
	 */
	render: function(){
		var i = 0;
		var rows = [];
		for(var product_id in this.dom_items) {
			i++;
			var product = this.dom_items[product_id];
			
			var row = this.elem('tr', {
				'class' : 'product-row',
				'data-row-id' : product.product.id,
				'id': 'item-' + i
			});

			var serial 					= this.elem('td', {}).text(i);
			var product_display	=	this.productDipslay(product, i);
			var price 					=	this.elem('td', {}).append(
															this.elem("input", {
																'value': product.price,
																'name': 'Item[' + i + '][price]',
																'class': 'form-control',
																'onChange': 'Pos.changePrice(this, ' + product_id + ')',
															})
														);
			// var total 					=	this.elem('td', {}).text(product.total);
			var dlt 						= this.elem("td", {
															'data-product-id': product_id,
															'class' : 'remove-item',
													}).append(this.elem('a', {
														'href' :'#',
														'onClick' : 'Pos.delete(' + product_id + ')',
													}).append("<i class='fa fa-close'></i>"))

			// quantity TD element
			var qty 						= 	this.elem('td', {
																'class': 'quantity-td td-input col-xs-3',
															})
															.append(this.elem('input', {
																	'type': 'text',
																	'value': product.qty,
																	'name' : 'Item[' + i + '][quantity]',
																	'class' : 'qty-input form-control',
																	'data-product-id': product_id,
																	'onChange': 'Pos.change(this, ' + product_id + ', 1)',
															}));



			var discount 						= 	this.elem('td', {
																'class': 'discount-td td-input col-xs-3',
															})
															.append(this.elem('input', {
																	'type': 'text',
																	'value': product.discount,
																	'name' : 'Item[' + i + '][discount]',
																	'class' : 'discount-input form-control',
																	'onChange': 'Pos.change(this, ' + product_id + ', 2)'
																	

															}));

			var total 						= 	this.elem('td', {
																'class': 'discount-td td-input col-xs-3',
															})
															.append(this.elem('input', {
																	'type': 'hidden',
																	'value': product.total,
																	'name' : 'Item[' + i + '][total]',
																	'class' : 'discount-input',	

															}),
																this.elem("span", {}).text(product.total)
															);

			var tonnage 						= 	this.elem('td', {
																'class': 'discount-td td-input col-xs-3',
															})
															.append(this.elem('input', {
																	'type': 'hidden',
																	'value': product.tonnage,
																	'name' : 'Item[' + i + '][tonnage]',
																	'class' : 'tonnage-input',	

															}),
																this.elem("span", {}).text(product.tonnage)
															); 

			row.append(serial, product_display, price, qty, discount, total, dlt);
			// $(".products-body").append(row);
			rows.push(row);

			
		}
		$(".products-body").html('');
		for (var i = 0; i < rows.length; i++) {
			var r = rows[i];

			$('.products-body').append(r);
		}
	},
	totals: function() {
			$("#sale-net_total").prop("value", this.total);
			$("#net_total_hidden").prop("value", this.total);
			$("#sale-discount").prop("value", this.grand_discount),
			$(".grand_total.txt").text(this.grand_total);
			$(".grand_total").prop('value', this.grand_total);
			// $("#sale-total_tonnage").prop('value', this.grand_tonnage);
	},
	hiddenElem: function(name, hiddenAttrs, tdAttrs, product, index){
		var display = this.elem('span', {}).append(name);
		var hidden = this.elem('input', hiddenAttrs);

		var product_name		=	this.elem('td',tdAttrs).append(display, hidden);

		return product_name;
	},

	productDipslay: function(product, index){
		var name 	=	product.product.name + " (" + product.product.size + ")";
		var display = this.elem('span', {}).append(name);
		var hidden = this.elem('input', {
			'type': 'hidden',
			'value': product.product.id,
			'name': 'Item[' + index + '][product_id]',
		});

		var product_name		=	this.elem('td', {
				'class' : 'product-id',
				'data-row-id' : product.product.id,

		}).append(display, hidden);

		return product_name;
	},

	elem: function(name, attrs){
		return $(document.createElement(name)).attr(attrs);
	},
	value: function(element, value) {
		element.append(value);
	}


}





function addItem(sale_id, product, action){
	// console.log(product);
	Pos.addItem(product);


}

</script>