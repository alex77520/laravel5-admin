<p class='alert alert-success'>角色权限(非资源)</p>
<table class="table table-bordered table-hover table-condensed">
<thead>
	<tr>
		<td style='width:120px;'>模块</td>
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
				<?php //if ($user->static_access($vv)):?>
				<?php //print_r($vv);?>
				<?php if ( $isSuper or in_array($vv->id, $loginUserPermissions)):?>
				<li style='float:left;padding-right:5px;'>
					<input class='static-perm' data-module-id="<?php echo $vv->id;?>" data-role-id="<?php echo
					$role->id;?>" <?php if(in_array($vv->id, $rolePermission)) echo 'checked="checked" data-op="revoke"'; else echo "data-op='grant'";?> type='checkbox' value='<?php echo $vv->id;?>' name='action' /><?php echo $vv->action_cn;?>
				</li>
				<?php endif;?>
			<?php endforeach;?>
			</ul>
		</td>
	</tr>
	<?php endforeach;?>
</tbody>
</table>
