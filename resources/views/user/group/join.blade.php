<?php
$title = '添加成员';
$id = 'join-group-modal';
$body = view('user.group.join_modal_body')->render();
$footer = view('user.group.join_modal_footer')->render();
echo view('share.modal')
	->with('title', $title)
	->with('id', $id)
	->with('body', $body)
	->with('footer', $footer)
	->render();
?>
<script src="{{ asset('js/user/group/join_group.js') }}" type="text/javascript"></script>
