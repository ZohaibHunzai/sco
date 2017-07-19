# checked
checked = $('#inventory-price_changed').is(':checked')
if checked then $('.prices').show() else $('.prices').hide()

$('#inventory-price_changed').change ->
	checked_two = $(this).is ':checked'
	if checked_two then $('.prices').show() else $('.prices').hide()
	

