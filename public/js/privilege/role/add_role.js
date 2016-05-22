$('a.add-role').click(function() {
	var that = $(this);
	var modal = 'add-role-modal';
	$('#' + modal).modal({'backdrop':'static'});
	$('#' + modal).on('hidden',function () {
		$(this).modal('hide')
		location.reload();
	});

	var form = 'add-role-form';
	$('#' + form).submit(function() {
		//var role = {'id':'', 'role':'', 'description':''};
		var role = {'role':'', 'description':'', '_csrf': kw_csrf};
		for(var i in role) {
			if (role.hasOwnProperty(i)) {
				role[i] = $('#' + form + ' input[name=' + i + ']').val();
			}
		}
		role.description = $('#' + form + ' textarea[name=description]').val();
		$.post('/privilege/operole', {'data':role, 'op':'add', '_token': kw_csrf}, function(data) {
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
			$('input.add-role-input').focus(function() {
				G.clean();
			});
		});
		return false;
	});
});
