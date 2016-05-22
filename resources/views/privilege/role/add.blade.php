<?php
$title = '新增角色';
$id = 'add-role-modal';
$body = view('privilege.role.add_modal_body')->render();
$footer = view('privilege.role.add_modal_footer')->render();
echo view('share.modal')
	->with('title', $title)
	->with('id', $id)
	->with('body', $body)
	->with('footer', $footer)
	->render();
?>
<script src="{{ asset('js/privilege/role/add_role.js') }}" type="text/javascript"></script>
<?php return;?>
