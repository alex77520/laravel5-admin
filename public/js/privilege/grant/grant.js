$(function(){ 
	function grant(data) {
		$.post('/privilege/opegrant', {'q':data, 'op':'grant'});
	}

	$('input.role').click(function() {
		var p = {'user_id':null, 'role_id':null}
		for (var i in p) {
			p[i] = $(this).attr('data-' + i.replace('_', '-'));
		}
		if ($(this).attr('checked') == 'checked') {
			op = 'grant';
			$(this).attr('data-op', 'revoke');
		} else {
			op = 'revoke';
			$(this).attr('data-op', 'grant');
		}
		var that = $(this);
		$.post('/privilege/opegrant', {'data':p, 'op': op, '_token': kw_csrf}, function(data) {
			if (G.code.succ != data.code) {
				alert('操作失败');
			} else {
			}
		},'json');

	});

});
