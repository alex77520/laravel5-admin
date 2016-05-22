<?php
$attr = array();
foreach (Config::get('admin.group.attr') as $k => $v){
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
		<li><a href="javascript:void(0)" class='delete-group' <?php echo $attr;?>>
				<i class="glyphicon glyphicon-trash"></i>&nbsp;<span style='font-size:12px;'> 删除</span></a></li>
		<li role="separator" class="divider"></li>
		<li><a href="javascript:void(0)" class='edit-group' <?php echo $attr;?>>
				<i class="glyphicon glyphicon-pencil"></i>&nbsp;<span style='font-size:12px;'> 修改</span></a></li>
		<li role="separator" class="divider"></li>
		<li><a href="javascript:void(0)" class='join-group' <?php echo $attr;?>>
				<i class="glyphicon glyphicon-plus"></i>&nbsp;<span style='font-size:12px;'> 添加成员</span></a></li>
		<li role="separator" class="divider"></li>
		<li><a href="javascript:void(0)" class='depart-group' <?php echo $attr;?>>
				<i class="glyphicon glyphicon-minus"></i>&nbsp;<span style='font-size:12px;'> 删除成员</span></a></li>
	</ul>
</div>
