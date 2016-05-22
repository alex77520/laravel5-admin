$('a.add-group').click(function() {
	var that = $(this);
	var modal = 'add-group-modal';
	$('#' + modal).modal({'backdrop':'static'});
	$('#' + modal).on('hidden',function () {
		$(this).modal('hide')
		location.reload();
	});

	var form = 'add-group-form';
	$('#' + form).submit(function() {
		//var group = {'id':'', 'groupname':'', 'description':''};
		var group = {'groupname':'', 'description':''};
		for(var i in group) {
			if (group.hasOwnProperty(i)) {
				group[i] = $('#' + form + ' input[name=' + i + ']').val();
			}
		}
		group.description = $('#' + form + ' textarea[name=description]').val();
		$.post('/user/opegroup', {'data':group, 'op':'add', '_token': kw_csrf}, function(data) {
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
			$('input.add-group-input').focus(function() {
				G.clean();
			});
		});
		return false;
	});
});
