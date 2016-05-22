<?php
$title = '删除账户';
$id = 'delete-account-modal';
$body = view('user.account.delete_modal_body')->render();
$footer = view('user.account.delete_modal_footer')->render();
echo view('share.modal')
	->with('title', $title)
	->with('id', $id)
	->with('body', $body)
	->with('footer', $footer)
	->render();
?>
<script src="{{ asset('js/user/account/delete_account.js') }}" type="text/javascript"></script>