
<p class='alert alert-success'>角色信息</p>

<table class="table table-striped table-bordered table-condensed">
<thead>
	<tr>
		<td style='width:120px;'>角色名</td>
		<td>描述</td>
		<td style='width:60px;'></td>
	</tr>
</thead>
<tbody>
	<tr>
		<td><?php echo $role->role;?></td>
		<td><?php echo $role->description;?></td>
		<td>
			<a href='javascript:void(0)' class='btn btn-mini btn-danger delete-role' data-id=<?php echo $role->id;?>>删除</a>
		</td>
	</tr>
</tbody>
</table>
