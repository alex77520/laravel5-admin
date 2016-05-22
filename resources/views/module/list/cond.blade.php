<link href="{{ asset('js/lib/select2/select2.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('js/lib/select2/select2.js') }}" type="text/javascript"></script>
<form method='GET' class="well form-inline" name='query-module' id='query-module-form' style='margin-bottom: 0px;'>
	<label class="control-label" for="module">模块分类：</label>
	<select id="module" class="input query-module-select2" name="module" style="width: 160px;">
		<option value="" <?php if(empty($_GET['m'])) echo 'selected="selected"' ?>>全部</option>
		<?php foreach($modules as $k => $v): ?>
		<option value="<?php echo $k ?>" <?php if(isset($_GET['m']) && $k ==$_GET['m']) echo 'selected="selected"' ?>><?php echo $v; ?></option>
		<?php endforeach; ?>
	</select>
	<!--
	<button id="query_submit" type="button" class="btn btn-primary">查询</button>  
	-->
</form>
<br/>
<script>
$(function(){
	$('.query-module-select2').select2();
	$('#query_submit').click(function(){
		var v = $('#module').val();
		window.location = '/module/modulelist?m=' + v;
	});
	$('#module').change(function(){
		var v = $('#module').val();
		window.location = '/module/modulelist?m=' + v;
	});
});

</script>
