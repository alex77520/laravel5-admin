$('a.add-module').click(function() {
	var that = $(this);
	var modal = 'add-module-modal';
	$('#' + modal).modal({'backdrop':'static'});
	$('#' + modal).on('hidden',function () {
		$(this).modal('hide');
		location.reload();
	});

	var form = 'add-module-form';
	$('#' + form).submit(function() {
		var module = {'module':'', 'module_cn':'', 'action':'', 'action_cn':'', 'module_type':'', 'description':'', 'order_by':'', 'gname':''};
		for(var i in module) {
			if (module.hasOwnProperty(i)) {
				module[i] = $('#' + form + ' input[name=' + i + ']').val();
			}
		}
		module.module_type = $('#' + form + ' select[name=module_type]').val();
		module.description = $('#' + form + ' textarea[name=description]').val();
		$.post('/module/opemodulelist', {'data':module, 'op':'add', '_token': kw_csrf}, function(data) {
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
			$('input.add-module-input').focus(function() {
				G.clean();
			});
		});
		return false;
	});
});
