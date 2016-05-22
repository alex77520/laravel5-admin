<?php
$title = '删除角色';
$id = 'delete-role-modal';
$body = view('privilege.role.delete_modal_body')->render();
$footer = view('privilege.role.delete_modal_footer')->render();
echo view('share.modal')
	->with('title', $title)
	->with('id', $id)
	->with('body', $body)
	->with('footer', $footer)
	->render();
?>
<script src="{{ asset('js/privilege/role/delete_role.js') }}" type="text/javascript"></script>