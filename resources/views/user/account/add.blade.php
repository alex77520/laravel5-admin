<?php
$title = '添加账户';
$id = 'add-account-modal';
$body = view('user.account.add_modal_body')->render();
$footer = view('user.account.add_modal_footer')->render();
echo view('share.modal')
	->with('title', $title)
	->with('id', $id)
	->with('body', $body)
	->with('footer', $footer)
	->render();
?>
<script src="{{ asset('js/user/account/add_account.js') }}" type="text/javascript"></script>