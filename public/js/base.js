var msg = function(data) {
	for(i in data.msg) return data.msg[i][0];
}

var G = {};
G.code = {
	'succ': 0
}
G.msg = function(text) {
var str = '<div  class="g_msg alert alert-info" id="profile-alert" ><button class="close" data-dismiss="alert">×</button><span class="msg"><strong>信息</strong> '+ text +'</span></div>';
return str;
}

G.error = function(text) {
var str = '<div style="line-height:18px;" class="g_msg alert alert-error" id="profile-alert" ><button class="close" data-dismiss="alert">×</button><span class="msg"><strong>错误</strong> '+ text +'</span></div>';
return str;
}

G.clean = function() {
$('div.g_msg').fadeOut('slow').remove();
}

G.node = {};
G.node.type = {'static':0, 'box':1, 'service':2, 'group': 3,'idc_id':6};

G.get_url = function(base_url, params) {
	var param_encoded = $.param(params);	
	var seperator = (base_url.indexOf('?') == -1) ? "?" : "&";
	return base_url + seperator + param_encoded;
};

window.Console = console;

$(window).scroll(function(){
	if (window.Select2 == undefined) return false;
	$(".select2-container.select2-dropdown-open").select2('close');
});

jQuery.extend({
	GlobalMessage : function(settings){
		var options = {
				Id: 'global_get_message',
			};
			$.extend(options, settings);
			
		var $this = $('#'+options.Id);
		$.post(
				'/pc/global_message', 
				//postdata,
				function(data) {
					if (data != 0) {
						$this.html('('+data+')');
						if($this.hasClass('hide')){
							$this.removeClass('hide');
						}
					} else {
						if(!$this.hasClass('hide')){
							$this.addClass('hide');
						}
					}
				}
			);
	}
});

