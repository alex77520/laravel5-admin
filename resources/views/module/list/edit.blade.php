<?php
$title = '编辑模块';
$id = 'edit-module-modal';
$body = view('module.list.edit_modal_body')->render();
$footer = view('module.list.edit_modal_footer')->render();
echo view('share.modal')
	->with('title', $title)
	->with('id', $id)
	->with('body', $body)
	->with('footer', $footer)
	->render();
?>
<script src="{{ asset('js/module/list/edit_module.js') }}" type="text/javascript"></script>
