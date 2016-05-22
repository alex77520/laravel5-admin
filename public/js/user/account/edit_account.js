$('a.edit-account').click(function() {
	var that = $(this);
	var modal = 'edit-account-modal';
	$('#' + modal + ' input[name=id]').val($(this).attr('data-id'));	
	$('#' + modal + ' input[name=username]').val($(this).attr('data-username'));	
	$('#' + modal + ' input[name=nickname]').val($(this).attr('data-nickname'));	
	$('#' + modal + ' input[name=email]').val($(this).attr('data-email'));	
	$('#' + modal + ' input[name=mobile]').val($(this).attr('data-mobile'));	

	$('#' + modal).modal({'backdrop':'static'});
	$('#' + modal).on('hidden',function () {
		$(this).modal('hide')
		location.reload();
	});

	var form = 'edit-account-form';
	$('#' + form).submit(function() {
		var account = {'id':'', 'username':'', 'nickname':'', 'mobile':'', 'email':''};
		for(var i in account) {
			if (account.hasOwnProperty(i)) {
				account[i] = $('#' + form + ' input[name=' + i + ']').val();
			}
		}
		$.post('/user/opeaccount', {'data':account, 'op':'edit', '_token': kw_csrf}, function(data) {
			G.clean();
			if (G.code.succ == data.code) {
				var msg = G.msg(data.msg);
				$(msg).prependTo($('#' + modal + ' div.modal-body'));
			} else {
				for(i in data.msg) {
					var msg = G.error(data.msg[i][0]);
					$(msg).prependTo($('#' + modal + ' div.modal-body'));
				}
			}
			$('input.edit-account-input').focus(function() {
				G.clean();
			});

		});
		return false;
	});
});
