function grant(data) {
	$.post('/privilege/role/', {'q':data, 'op':'grant'});
}
function revoke(data) {
	$.post('/privilege/role/', {'q':data, 'op':'revoke'});
}

$(function () {
	$('#bind-res a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
});
