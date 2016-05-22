$('a.delete-group').click(function() {
	var that = $(this);
	var modal = 'delete-group-modal';
	$('#' + modal).modal({'backdrop':'static'});
	$('#' + modal).on('hidden',function () {
		$(this).modal('hide')
		location.reload();
	});
	$('#' + modal + ' input[name=id]').val($(this).attr('data-id'));	

	var form = 'delete-group-form';
	$('#' + form).submit(function() {
		var group = {'id':'', 'groupname':'', 'description':''};
		for(var i in group) {
			if (group.hasOwnProperty(i)) {
				group[i] = $('#' + form + ' input[name=' + i + ']').val();
			}
		}
		$.post('/user/opegroup', {'data':group, 'op':'delete', '_token': kw_csrf}, function(data) {
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
			$('input.delete-group-input').focus(function() {
				G.clean();
			});
		});
		return false;
	});
});
