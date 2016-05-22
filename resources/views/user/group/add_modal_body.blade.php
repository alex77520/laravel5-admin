<form method='POST' class='form-horizontal' name='add-group' id='add-group-form' >
<div class="modal-body">
<?php echo view('share.input.text')
		->with('label', '组名')
		->with('name', 'groupname')
		->with('id', 'groupname')
		->with('value', '')
		->with('class', 'form-control')
		->render();?>

<?php echo view('share.input.textarea')
		->with('label', '描述')
		->with('name', 'description')
		->with('id', 'description')
		->with('value', '')
		->with('class', 'form-control')
		->render();?>
