$('#cash-collection-create').find('.recieve-mode').on 'change', ()->
	val = parseInt($(this).val())

	if val == 30
		$('#cash-collection-create').find('.bank-account-details').removeClass('hide')
	else
		$('#cash-collection-create').find('.bank-account-details').addClass('hide')

