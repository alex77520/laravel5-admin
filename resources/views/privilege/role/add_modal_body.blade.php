<form method='POST' class='form-horizontal' id='add-role-form' name='add-role' >
<div class="modal-body">
<?php echo view('share.input.text')
		->with('label', '角色名')
		->with('name', 'role')
		->with('id', 'role')
		->with('value', '')
		->with('class', 'input add-role-input')
		->render();?>
<?php echo view('share.input.textarea')
		->with('label', '描述')
		->with('name', 'description')
		->with('id', 'description')
		->with('value', '')
		->with('class', 'input add-role-input')
		->render();?>
