$('a.depart-group').click(function() {
	var that = $(this);
	var id = $(this).attr('data-id');
	var modal = 'depart-group-modal';
	$('#' + modal).modal({'backdrop':'static'});
	$('#' + modal).on('hidden',function () {
		$(this).modal('hide')
		location.reload();
	});
	var foreigner = null;
	var group = {'id':id};
	var form = 'depart-group-form';
	$.post('/user/opegroup', {'op':'member', 'data':group, '_token': kw_csrf}, function(data) {
		var li = [];
		for (var i in data) {
			li.push('<li style="list-style:none;padding-right:5px;margin:0px;float:left;"><input type="checkbox" name="user_id" value="'+data[i].id+'" /> '+data[i].username+' </li>');
		}
		li = li.join(' ');
		$('<ul>'+li+'</ul>').appendTo($('#' + modal + ' div.modal-body'));
		$('#' + form).submit(function() {
			var r = {'group_id':id, 'user_id':[]}
			$('#'+modal+' input[name=user_id]').each(function() {
				if ($(this).attr('checked') == 'checked') r['user_id'].push($(this).val());
			});
			$.post('/user/opegroup', {'op':'depart', 'data':r, '_token': kw_csrf}, function(data) {
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
			}, 'json');
			return false;
		});
		$('input[name=user_id]').focus(function() {
				G.clean();
		});
	}, 'json')

});
