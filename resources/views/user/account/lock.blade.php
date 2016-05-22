<?php
$title = '锁定账户';
$id = 'lock-account-modal';
$body = view('user.account.lock_modal_body')->render();
$footer = view('user.account.lock_modal_footer')->render();
echo view('share.modal')
	->with('title', $title)
	->with('id', $id)
	->with('body', $body)
	->with('footer', $footer)
	->render();
?>
<script src="{{ asset('js/user/account/lock_account.js') }}" type="text/javascript"></script>
