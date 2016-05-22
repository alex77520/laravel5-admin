$('a.delete-role').click(function() {
	var that = $(this);
	var modal = 'delete-role-modal';
	$('#' + modal).modal({'backdrop':'static'});
	$('#' + modal).on('hidden',function () {
		$(this).modal('hide')
		location.reload();
	});
	$('#' + modal + ' input[name=id]').val($(this).attr('data-id'));	

	var form = 'delete-role-form';
	$('#' + form).submit(function() {
		var role = {'id':'', '_csrf': kw_csrf};
		for(var i in role) {
			if (role.hasOwnProperty(i)) {
				role[i] = $('#' + form + ' input[name=' + i + ']').val();
			}
		}
		$.post('/privilege/operole', {'data':role, 'op':'delete', '_token': kw_csrf}, function(data) {
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
			$('input.delete-role-input').focus(function() {
				G.clean();
			});
		});
		return false;
	});
});
