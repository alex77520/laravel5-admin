
<form method='POST' class='form-horizontal' name='edit-module' id='edit-module-form' >

<div class="modal-body">
	<input type="hidden" name="id">
	<?php echo view('share.input.text')
		->with('label', '模块名称')
		->with('name', 'module')
		->with('id', 'module')
		->with('value', '')
		->with('class', 'form-control')
		->render();?>

	<?php echo view('share.input.text')
		->with('label', '模块中文名称')
		->with('name', 'module_cn')
		->with('id', 'module_cn')
		->with('value', '')
		->with('class', 'form-control')
		->render();?>

	<?php echo view('share.input.text')
		->with('label', '模块子项')
		->with('name', 'action')
		->with('id', 'action')
		->with('value', '')
		->with('class', 'form-control')
		->render();?>

	<?php echo view('share.input.text')
		->with('label', '模块子项中文名称')
		->with('name', 'action_cn')
		->with('id', 'action_cn')
		->with('value', '')
		->with('class', 'form-control')
		->render();?>

	<?php echo view('share.input.select')
		->with('label', '模块类型')
		->with('name', 'module_type')
		->with('id', 'module_type')
		->with('kv', array('0' => '不绑定资产','1' => '绑定资产','2' => '分公司'))
		->with('opt', array('style' => 'width: 220px'))
		->with('class', 'form-control')
		->render();?>

	<?php echo view('share.input.textarea')
		->with('label', '模块描述')
		->with('name', 'description')
		->with('id', 'description')
		->with('value', '')
		->with('class', 'form-control')
		->render();?>

	<?php echo view('share.input.text')
		->with('label', '排序')
		->with('name', 'order_by')
		->with('id', 'order_by')
		->with('value', '')
		->with('class', 'form-control')
		->render();?>

	<?php echo view('share.input.text')
		->with('label', '模块子项分组名')
		->with('name', 'gname')
		->with('id', 'gname')
		->with('value', '')
		->with('class', 'form-control')
		->render();?>

