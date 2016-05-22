$(function() {
	$('#profile-form').submit(function(){
		var nickname	=	$('#nickname').val();
		var email 		=	$('#email').val();
		var mobile		=	$('#mobile').val();
		$.post('/personal/setprofile', {'nickname':nickname, 'email':email, 'mobile':mobile, '_token': kw_csrf}, function(data) {
			G.clean();
			if (G.code.succ == data.code) {
				var msg = G.msg(data.msg);
				$('#right-legend').after(msg);
			} else {
				for(i in data.msg) {
					msg = G.error(data.msg[i][0]);
					$('#right-legend').after(msg);
				}
			}
			$('input.profile-input').focus(function() {
				G.clean();
			});
		});
		return false;
	});
	$('#changepw-form').submit(function(){
		var oldpasswd		=	$('#oldpassword').val();
		var newpasswd 		=	$('#newpassword').val();
		var confirmpasswd	=	$('#confirmpassword').val();
		$.post('/personal/setchangepw', {'oldpassword':oldpasswd, 'newpassword':newpasswd, 'confirmpassword':confirmpasswd, '_token': kw_csrf}, function(data) {
			G.clean();
			if (G.code.succ == data.code) {
				var msg = G.msg(data.msg);
				$('#right-legend').after(msg);
				location.href='/auth/logout';
			} else {
				for(i in data.msg) {
					msg = G.error(data.msg[i][0]);
					$('#right-legend').after(msg);
					break;
				}
			}
			$('input.profile-input').focus(function() {
				G.clean();
			});
		});
		return false;
	});
});
