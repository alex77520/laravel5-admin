
<a class='btn btn-primary pull-right add-role' style="margin: 10px auto">添加角色</a>
<p class='alert alert-success'>角色列表</p>
<table class="table table-striped table-bordered table-condensed">
<thead>
	<tr>
		<th style='width:120px;'>用户</th>
		<th>角色</th>
    </tr>
</thead>
<tbody>
	<?php foreach ($roles as $v):?>
	<tr>
		<td class='user'>{{ $v['user']->username or $v['user']['username']}}</td>
		<td>
		<ul>
		<?php foreach ($v['role'] as $vv):?>
			<li style='padding-right:10px;float:left;'>
				<a href='?role=<?php echo $vv->id;?>' class='role' data-id='<?php echo $vv->id;?>'><?php echo $vv->role;?></a></li>
		<?php endforeach;?>
		</ul>
		</td>
	</tr>
	<?php endforeach;?>
</tbody>
</table>
