<?php
$title = '账户已锁定！';
$id = 'lock-account-modal';
echo view('share.modal_show')
	->with('title', $title)
	->with('id', $id)
	->render();
?>
