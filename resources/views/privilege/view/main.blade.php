<?php echo view('share.header')->with('nav', Session::get('nav', array()))->with('moduleActions', Session::get('moduleActions', array()))->with('action', $action)->render() ?>

<?php echo view('share.legend')->with('action', $action->action_cn)->with('start_page', $action->module.'#'.$action->action)->render();?>
<div class="alert" style='background-color:white;margin-top:-20px;'>

<br />
<?php echo view('privilege.view.group')
	->with('groups', $groups)
	->with('current', $current)
	->render();?>
<?php if ($current):?>
<?php echo view('privilege.view.static_perm')
	->with('allStaticModule', $allStaticModule)
	->with('current', $current)
	->with('currentRolePermission', $currentRolePermission)
	->render();?>
<?php echo view('privilege.view.company_perm')
	->with('allCompanyModule', $allCompanyModule)
	->with('currentRolePermission', $currentRolePermission)
	->with('current', $current)
	->render();?>

<?php endif;?>
</div>

<?php echo view('share.footer')->render() ?>
