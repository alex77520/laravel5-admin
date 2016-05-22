<div style='clear:both'></div>
<span class='alert alert-success' style="padding: 5px auto">共 <span class="badge">{{$modules->total()}}</span> 条记录</span>
<a class='btn btn-primary pull-right add-module' style="margin: 5px auto">添加模块或者分公司</a>
<table class="table table-bordered table-hover table-condensed">
	<thead>
		<tr>
		<?php foreach (Config::get('admin.modules.attr') as $k => $v):?>
			<th><?php echo $v;?></th>
		<?php endforeach;?>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php
		$module_type = array(0 =>'不绑定资产',1 => '绑定资产',2 => '公司');?>
		<?php foreach($modules as $u):?>
		<tr id='module-<?php echo $u->id;?>'>
			<?php foreach (Config::get('admin.modules.attr') as $k => $v):?>
			<td class='<?php echo $k;?>'>
				<?php if($k == 'module_type') {
					echo $module_type[$u->$k];
					} else {
					echo $u->$k;}
				?></td>
			<?php endforeach;?>
			<td style='width:80px;'>
				<?php echo View::make('module.list.operation')
					->with('b', $u)
					->render();?>
			</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>

<div class="pull-right">
	@if(isset($_GET['m']))
  		{!! $modules->appends(['m' => $_GET['m']])->render() !!}
	@else
		{!! $modules->render() !!}
	@endif
</div>
{{--<div class="pull-right">--}}
	{{--<ul class="pagination">--}}
		{{--<li>--}}
			{{--<span style="padding: 0;height: 30px;">--}}
				{{--<input type="text" size="10" style="margin: 0;padding: 0;height:100%;width:50px;" value="{{$modules->perPage()}}"/>--}}
			{{--<span>--}}
		{{--</li>--}}
	{{--</ul>--}}
{{--</div>--}}
<div style='clear:both'></div>
