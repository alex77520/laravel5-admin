<?php
$title = '删除成员';
$id = 'depart-group-modal';
$body = view('user.group.depart_modal_body')->render();
$footer = view('user.group.depart_modal_footer')->render();
echo view('share.modal')
	->with('title', $title)
	->with('id', $id)
	->with('body', $body)
	->with('footer', $footer)
	->render();
?>
<script src="{{ asset('js/user/group/depart_group.js') }}" type="text/javascript"></script>
