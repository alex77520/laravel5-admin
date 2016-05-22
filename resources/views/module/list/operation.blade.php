<?php
$attr = array();
foreach (Config::get('admin.modules.attr') as $k => $v){
	$attr[] = 'data-' . str_replace('_', '-', $k) . "='{$b->$k}'";
}
$attr = implode(' ', $attr);
?>

<div class="btn-group pull-right">
	<button class="btn btn-success dropdown-toggle" data-toggle="dropdown" href="#">
		<i class="glyphicon glyphicon-cog"></i> 操作
		<span class="caret"></span>
	</button>
<ul class="dropdown-menu">

	<li><a href="javascript:void(0)" class='delete-module' <?php echo $attr;?>>
			<i class="glyphicon glyphicon-trash"></i>&nbsp;<span style='font-size:12px;'> 删除</span></a></li>
	<li role="separator" class="divider"></li>
	<li><a href="javascript:void(0)" class='edit-module' <?php echo $attr;?>>
			<i class="glyphicon glyphicon-pencil"></i>&nbsp;<span style='font-size:12px;'> 修改</span></a></li>
</ul>
</div>
