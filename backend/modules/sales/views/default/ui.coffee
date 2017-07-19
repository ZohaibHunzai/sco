class ui
	elemen: (type, data, classes)->
		return $(type).html(data).prop({class: classes})
	products: (items) ->
			$('.items').append this.product_item for i in [1..12]
		# for i in [1..2]
	product_item: (data)->
		str = "
			<div class='product-item'>
				<a href='#' class='close-btn'><i class='fa fa-close'></i></a>
				<div class='row'>
					<div class='col-md-4'>
						<strong class='item-sku'>{sku}</strong>
						<span class='item-name'>uBank Software</span>
						<span class='price-tag'>12,000</span>
					</div>
					<div class='col-md-4'>
						<div class='row'>
							<div class='col-md-6'>
								<div class='qty'>
									<label>Qty</label>
									<input type='text' class='form-control'>
								</div>
							</div>
							<div class='col-md-6'>
								<div class='disc'>
									<label>Discount</label>
									<input type='text' class='form-control'>
								</div>
							</div>
							
						</div>
					</div>
					<div class='col-md-4'>
						<div class='item-total-outer'>
							<span class='item-total-text'>Total</span>
							<strong class='item-total'>{item_total}</strong>
						</div>
					</div>
				</div>
			</div>"


ui = new ui
ui.products({})