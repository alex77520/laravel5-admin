<?php
$title = '删除组';
$id = 'delete-group-modal';
$body = view('user.group.delete_modal_body')->render();
$footer = view('user.group.delete_modal_footer')->render();
echo view('share.modal')
	->with('title', $title)
	->with('id', $id)
	->with('body', $body)
	->with('footer', $footer)
	->render();
?>
<script src="{{ asset('js/user/group/delete_group.js') }}" type="text/javascript"></script>
