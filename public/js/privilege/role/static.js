$(function(){
	$('input.static-perm').click(function (){
		var that = $(this);
		var p = {'node_id':0, 'node_type':0, 'module_id':null, 'role_id':null }
		p.module_id = $(this).attr('data-module-id');
		p.role_id = $(this).attr('data-role-id');
		var op = '';
		if ($(this).attr('checked') == 'checked') {
			op = 'grant';
			$(this).attr('data-op', 'revoke');
		} else {
			op = 'revoke';	
			$(this).attr('data-op', 'grant');
		}
		var that = $(this);
		$.post('/privilege/operole', {'data':p, 'op': op, '_token': kw_csrf}, function(data) {
			if (G.code.succ != data.code) {
				that.attr('checked', '');
				alert('操作失败');
			} else {
			}
		},'json');
	});
});
