$('a.delete-module').click(function() {
	var that = $(this);
	var modal = 'delete-module-modal';
	$('#' + modal).modal({'backdrop':'static'});
	$('#' + modal).on('hidden',function () {
		$(this).modal('hide');
		location.reload();
	});
	$('#' + modal + ' input[name=id]').val($(this).attr('data-id'));	

	var form = 'delete-module-form';
	$('#' + form).submit(function() {
		var module = {'id':'', 'module':'', 'module_cn':'', 'action':'', 'action_cn':'', 'module_type':'', 'description':'', 'order_by':'', 'gname':''};
		for(var i in module) {
			if (module.hasOwnProperty(i)) {
				module[i] = $('#' + form + ' input[name=' + i + ']').val();
			}
		}
		$.post('/module/opemodulelist', {'data':module, 'op':'delete', '_token': kw_csrf}, function(data) {
			G.clean();
			if (G.code.succ == data.code) {
				var msg = G.msg(data.msg);
				$(msg).prependTo($('#' + modal + ' div.modal-body'));
				$('#' + modal).modal('hide');
				location.reload();
			} else {
				for(i in data.msg) {
					var msg = G.error(data.msg[i][0]);
					$(msg).prependTo($('#' + modal + ' div.modal-body'));
				}
			}
			$('input.delete-module-input').focus(function() {
				G.clean();
			});
		});
		return false;
	});
});
