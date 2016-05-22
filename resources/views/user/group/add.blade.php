<?php
$title = '添加组';
$id = 'add-group-modal';
$body = view('user.group.add_modal_body')->render();
$footer = view('user.group.add_modal_footer')->render();
echo view('share.modal')
	->with('title', $title)
	->with('id', $id)
	->with('body', $body)
	->with('footer', $footer)
	->render();
?>
<script src="{{ asset('js/user/group/add_group.js') }}" type="text/javascript"></script>
