<p class='alert alert-success'>角色权限</p>
<table class="table table-bordered table-hover table-condensed">
<thead>
	<tr>
		<td style='width:100px;'>模块</td>
		<td>子模块</td>
	</tr>
</thead>
<tbody>
	<?php foreach($allStaticModule as $k=>$v):?>
	<tr>
		<td><?php echo $v[0]->module_cn;?></td>
		<td>
			<ul>
			<?php foreach ($v as $vv):?>
				<li style='float:left;padding-right:5px;'>
					<input class='static-perm' type='checkbox' <?php if(in_array($vv->id, $currentRolePermission)) echo "checked='checked'"?>  disabled='disabled'/><?php echo $vv->action_cn;?>
				</li>
			<?php endforeach;?>
			</ul>
		</td>
	</tr>
	<?php endforeach;?>
</tbody>
</table>
