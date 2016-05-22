<table class="table table-striped table-bordered table-condensed">
<thead>
	<tr>
		<th style='width:100px;'>组名</th>
		<th>用户</th>
    </tr>
</thead>
<tbody>
	<?php foreach ($groups as $v):?>
	<tr>
		<td class='group'><?php echo $v->groupname;?></td>
		<td>
			<ul>
			<?php foreach ($v->users as $user):?>
				<li style='float:left;padding-right:5px;'><a <?php if(isset($current) and $user->id == $current->id) echo "class='bg-primary'";?> href='?u=<?php echo $user->id;?>'><?php echo $user->nickname ? $user->nickname : $user->username;?></a></li>
			<?php endforeach;?>
			</ul>
		</td>
	</tr>
	<?php endforeach;?>
</tbody>
</table>
