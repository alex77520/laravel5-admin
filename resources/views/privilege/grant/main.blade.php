<?php echo view('share.header')->with('nav', Session::get('nav', array()))->with('moduleActions', Session::get('moduleActions', array()))->with('action', $action)->render() ?>
<fieldset style='margin-top:20px;'>
<?php echo view('share.legend')->with('action', $action->action_cn)->with('start_page', $action->module.'#'.$action->action)->render();?>
<div class="alert" style='background-color:white;margin-top:-20px;'>
<p class='alert alert-success'>角色分配</p>
<br />
<?php echo view('privilege.grant.group')
	->with('groups', $groups)
	->with('current', $current)
	->render();?>
<?php if ($current):?>
<?php echo view('privilege.grant.role')
	->with('roles', $roles)
	->with('current', $current)
	->with('currentOwnRole', $currentOwnRole)
	->render();?>
<?php endif;?>
</div>
</fieldset>
<script src="{{ asset('js/privilege/grant/grant.js') }}" type="text/javascript"></script>
<?php echo view('share.footer')->render() ?>
