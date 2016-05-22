$('a.edit-module').click(function() {
	var that = $(this);
	var modal = 'edit-module-modal';
	$('#' + modal + ' input[name=id]').val($(this).attr('data-id'));
	$('#' + modal + ' input[name=module]').val($(this).attr('data-module'));
	$('#' + modal + ' input[name=module_cn]').val($(this).attr('data-module-cn'));
	$('#' + modal + ' input[name=action]').val($(this).attr('data-action'));
	$('#' + modal + ' input[name=action_cn]').val($(this).attr('data-action-cn'));
	$('#' + modal + ' select[name=module_type]').val($(this).attr('data-module-type'));
	$('#' + modal + ' textarea[name=description]').val($(this).attr('data-description'));
	$('#' + modal + ' input[name=order_by]').val($(this).attr('data-order-by'));
	$('#' + modal + ' input[name=gname]').val($(this).attr('data-gname'));



	$('#' + modal).modal({'backdrop':'static'});
	$('#' + modal).on('hidden',function () {
		$(this).modal('hide');
		location.reload();
	});

	var form = 'edit-module-form';
	$('#' + form).submit(function() {
		var module = {'id':'', 'module':'', 'module_cn':'', 'action':'', 'action_cn':'', 'module_type':'', 'description':'', 'order_by':'', 'gname':''};
		for(var i in module) {
			if (module.hasOwnProperty(i)) {
				module[i] = $('#' + form + ' input[name=' + i + ']').val();
			}
		}
		module.module_type = $('#' + form + ' select[name=module_type]').val();
		module.description = $('#' + form + ' textarea[name=description]').val();
		console.log('33344455566');
		$.post('/module/opemodulelist', {'data':module, 'op':'edit', '_token': kw_csrf}, function(data) {
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
			$('input.edit-module-input').focus(function() {
				G.clean();
			});

		});
		return false;
	});
});
