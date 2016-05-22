$(function() {

	$('a.group-member').click(function() {
		if ($(this).attr('class').indexOf('bg-primary') == '-1')	{
			$(this).addClass('bg-primary');
		} else {
			$(this).removeClass('bg-primary');
		}
		var user_id = $(this).attr('data-user-id');
		var group_id = $(this).attr('data-group-id');
		var group = {'user_id':user_id, 'group_id':group_id};
		$.post('/user/opegroup', {'data':group, 'op':'lead', '_token': kw_csrf}, function(data) {
			if (G.code.succ != data.code) {
				alert('操作失败');
			}
		}, 'json');
		return false;
	});

});
