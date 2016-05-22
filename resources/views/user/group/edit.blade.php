<?php
$title = '编辑组';
$id = 'edit-group-modal';
$body = view('user.group.edit_modal_body')->render();
$footer = view('user.group.edit_modal_footer')->render();
echo view('share.modal')
	->with('title', $title)
	->with('id', $id)
	->with('body', $body)
	->with('footer', $footer)
	->render();
?>
<script src="{{ asset('js/user/group/edit_group.js') }}" type="text/javascript"></script>
