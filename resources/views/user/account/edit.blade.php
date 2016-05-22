<?php
$title = '编辑账户';
$id = 'edit-account-modal';
$body = View::make('user.account.edit_modal_body')->render();
$footer = View::make('user.account.edit_modal_footer')->render();
echo View::make('share.modal')
	->with('title', $title)
	->with('id', $id)
	->with('body', $body)
	->with('footer', $footer)
	->render();
?>
<script src="{{ asset('js/user/account/edit_account.js') }}" type="text/javascript"></script>