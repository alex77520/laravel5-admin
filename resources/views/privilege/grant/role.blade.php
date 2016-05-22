<table class="table table-striped table-bordered table-condensed">
<thead>
	<tr>
		<th style='width:100px;'>用户</th>
		<th>角色</th>
    </tr>
</thead>
<tbody>
	<?php foreach ($roles as $v):?>
	<tr>
		<td class='user'>
		<?php
			if(is_array($v['user'])){
				echo $v['user']['username'];
			}else{
				echo $v['user']->nickname ? $v['user']->nickname : $v['user']->username;
			}
		?>
		</td>
		<td>
		<ul>
		<?php foreach ($v['role'] as $vv):?>
			<li style='padding-right:10px;float:left;'>
				<input class='role' <?php if(in_array($vv->id, $currentOwnRole)) echo "checked='checked' data-op='revoke'"; else echo "data-op='grant'";?> type='checkbox' name='role' data-role-id="<?php echo $vv->id;?>" data-user-id="<?php echo $current->id;?>"><?php echo $vv->role;?>
			</li>
		<?php endforeach;?>
		</ul>
		</td>
	</tr>
	<?php endforeach;?>
</tbody>
</table>
