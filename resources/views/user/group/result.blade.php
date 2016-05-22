<div style='clear:both'></div>
<span class='alert alert-success'>共 <span class="badge">{{$groups->total()}}</span> 条记录</span>
<a class='btn btn-mini btn-primary pull-right add-group' style="margin: 5px auto">添加组</a>
<table class="table table-bordered table-hover table-condensed">
	<thead>
		<tr>
		<?php foreach (Config::get('admin.group.attr') as $k => $v):?>
			<th><?php echo $v;?></th>
		<?php endforeach;?>
			<th>组员</th>
			<th></th>
		</tr>
	</thead>
	<tbody>

		<?php foreach($groups as $u):?>
		<tr id='group-<?php echo $u->id;?>'>
			<?php foreach (Config::get('admin.group.attr') as $k => $v):?>
			<td class='<?php echo $k;?>'><?php echo $u->$k;?></td>
			<?php endforeach;?>
			<td>
			<ul style='margin:0px;'>
			<?php foreach( (new \App\Models\Bizservice\AdminGroupSvc())->groupMembers($u->id) as $m):?>
				<li style='float:left;margin:0px;list-style:none;padding-right:5px;'>
					<a href='javascript:void(0)' class='group-member <?php if($m->is_leader == 1)echo 'bg-primary';?>' data-group-id='<?php echo $u->id;?>' data-user-id='<?php echo $m->id?>' ><?php echo $m->nickname ? $m->nickname : $m->username;?></a>
				</li>
			<?php endforeach;?>
			</ul>
			</td>
			<td style='width:80px;'>
				<?php echo view('user.group.operation')
					->with('b', $u)
					->render();?>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<div class="pull-right">
	{!! $groups->render() !!}
</div>
<div style='clear:both'></div>
