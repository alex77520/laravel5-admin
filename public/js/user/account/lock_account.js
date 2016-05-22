$('a.lock-account').click(function() {
	var that = $(this);
	var modal = 'lock-account-modal';
	$('#' + modal).modal({'backdrop':'static'});
	$('#' + modal).on('hidden',function () {
		$(this).modal('hide')
		location.reload();
	});
	$('#' + modal + ' input[name=id]').val($(this).attr('data-id'));	

	var form = 'lock-account-form';
	$('#' + form).submit(function() {
		var account = {'id':'', 'username':'', 'nickname':'', 'mobile':'', 'email':''};
		for(var i in account) {
			if (account.hasOwnProperty(i)) {
				account[i] = $('#' + form + ' input[name=' + i + ']').val();
			}
		}
		$.post('/user/opeaccount', {'data':account, 'op':'lock', '_token': kw_csrf}, function(data) {
			G.clean();
			if (G.code.succ == data.code) {
				var msg = G.msg(data.msg);
				$(msg).prependTo($('#' + modal + ' div.modal-body'));
				$('#' + modal).modal('hide')
				location.reload();
			} else {
				for(i in data.msg) {
					var msg = G.error(data.msg[i][0]);
					$(msg).prependTo($('#' + modal + ' div.modal-body'));
				}
			}
			$('input.lock-account-input').focus(function() {
				G.clean();
			});
		});
		return false;
	});
});
