<?php
$title = '删除模块';
$id = 'delete-module-modal';
$body = view('module.list.delete_modal_body')->render();
$footer = view('module.list.delete_modal_footer')->render();
echo view('share.modal')
	->with('title', $title)
	->with('id', $id)
	->with('body', $body)
	->with('footer', $footer)
	->render();
?>
<script src="{{ asset('js/module/list/delete_module.js') }}" type="text/javascript"></script>
