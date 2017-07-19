
class Sale
	sale_data: [
		items: [
			{product_id: 1, qty: 2, discount: 30},
			{product_id: 2, qty: 20, discount: 30},
			{product_id: 3, qty: 12, discount: 0.0},
		],
		customer_id: 3,
		payment_type: 30,

		

	]
	items: [] # this will be pulled from server
	customers: null # from server
	products: [] # server
	sale_id: null
	logger: true
	new_item: () ->
		this.items.push({product_id:1, sale_id:1, blah:2})
	remove_item: (item_id) ->
		this.items.splice this.items.indexOf item_id

	get_customers: ()->
		if this.customers == null
			$.ajax({
				url: $('#sales').data('server'),
				type: 'GET',
				context: this,
				dataType: 'josn',
				# contentType: "application/json;charset=utf-8",
				data: {what: 'customers'},
			}).success((data) -> 
					this.customers = data
					console.log this.customres
			)
			this.customers
			
		else
			return this.customers
	
	setState: (key, data) ->
		this.key = data
	get_products: ()->
		# _this = this
		$.ajax({
			url: $('#sales').data('server'),
			type: 'GET',
			context: this
			dataType: 'json',
			data: {what: 'products'},
		}).success((data) ->
			this.products = data
			# console.log(this.products)
		)
	
	load_data: (callback)->
		this.get_customers()
		this.get_products()
		callback.call(this)

	display: ()->
		console.log this.products
		for item in this.products
			console.log item

$(document).ready () ->
	sale = new Sale
	sale.load_data(() ->
			this.display()
	)

	# sale.process()
