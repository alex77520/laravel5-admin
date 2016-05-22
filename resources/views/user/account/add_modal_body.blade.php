<form method='POST' class='form-horizontal' name='add-account' id='add-account-form' >
<div class="modal-body">
<?php echo view('share.input.text')
		->with('label', '用户名')
		->with('name', 'username')
		->with('id', 'username')
		->with('value', '')
		->with('class', 'form-control')
		->render();?>

	<?php echo view('share.input.text')
		->with('label', '显示名')
		->with('name', 'nickname')
		->with('id', 'nickname')
		->with('value', '')
		->with('class', 'form-control')
		->render();?>

	<?php echo view('share.input.text')
		->with('label', 'Email')
		->with('name', 'email')
		->with('id', 'email')
		->with('value', '')
		->with('class', 'form-control')
		->render();?>

	<?php echo view('share.input.text')
		->with('label', '手机')
		->with('name', 'mobile')
		->with('id', 'mobile')
		->with('value', '')
		->with('class', 'form-control')
		->render();?>

