item = (name, current_value)->
	$('#assigned-selected-accounts').append(
		$(document.createElement('div'))
			.attr({'class': 'col-md-3'})
			.append(
				$(document.createElement("div"))
					.attr({'class': 'form-group'})
					.append 
						$(document.createElement('label')).attr({'class': 'control-label'})
							.append $(document.createElement('input')).attr({
								'type': 'checkbox',
								'checked': true,
								'name': 'Account[' + current_value + '][account_id]',
							}), " " + name)

	);
	_assigned_accounts.push(current_value)


_assigned_accounts = []
$('.assign-accounts').find('.account-chooser').on 'change', ->
	current_value = parseInt($(this).val());
	# alert(_assigned_accounts.indexOf(current_value));
	
	if !($.inArray(current_value, _assigned_accounts) >= 0)
		url = $(this).data 'url'
		$.getJSON url, {id: current_value}, (r)->
			item(r.name, current_value)
	else
		alert "Already added"

# load default
if $('#assigned-selected-accounts').length > 0
	url = $('#assigned-selected-accounts').data('default-url')
	
	# load default values to form.
	$.getJSON url, {}, (r)->
		for v in r
			item(v.account.name, parseInt(v.account_id))


	# div.form-group ->label