<?php
$title = '添加模块';
$id = 'add-module-modal';
$body = view('module.list.add_modal_body')->render();
$footer = view('module.list.add_modal_footer')->render();
echo view('share.modal')
	->with('title', $title)
	->with('id', $id)
	->with('body', $body)
	->with('footer', $footer)
	->render();
?>
<script src="{{ asset('js/module/list/add_module.js') }}" type="text/javascript"></script>