$('#customer-region_id').change ()->
	value 	= 	$(this).val()
	url 		= 	$(this).data 'url'

	$.get(url, {id: value}, (data) ->
		$('#customer-town_id').html(data)
	)