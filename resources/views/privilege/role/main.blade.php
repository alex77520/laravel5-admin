<?php echo view('share.header')->with('nav', Session::get('nav', array()))->with('moduleActions', Session::get('moduleActions', array()))->with('action', $action)->render() ?>

<fieldset style='margin-top:20px;'>
<?php echo view('share.legend')->with('action', $action->action_cn)->with('start_page', $action->module.'#'.$action->action)->render();?>
<div class="alert" style='background-color:white;margin-top:-20px;'>
<br />
<?php echo view('privilege.role.list')
	->with('roles', $roles)
	->render();?>
</div>
</fieldset>

<?php if ($role):?>
<div class="alert alert-info" style='background-color:white;margin-top:10px;'>
<?php echo view('privilege.role.role_info')
	->with('role', $role)
	->render();?>
<?php echo view('privilege.role.static_perm')
        ->with('allStaticModule', $allStaticModule)
        ->with('role', $role)
        ->with('isSuper', $isSuper)
        ->with('loginUserPermissions', $loginUserPermissions)
        ->with('rolePermission', $rolePermission)
//        ->with('user', $user)
        ->render();?>
</div>
<div class="tab-content">
	<div class="tab-pane active" id="boxes">
		<?php echo view('privilege.role.company_perm')
				->with('allStaticModule', $allStaticModule)
				->with('role', $role)
				->with('loginUserPermissions', $loginUserPermissions)
				->with('rolePermission', $rolePermission)
				->with('allCompanyModule', $allCompanyModule)
				->with('role', $role)
				->render();?>
	</div>
</div>
<?php endif;?>

<?php echo view('privilege.role.add')->render();?>
<?php echo view('privilege.role.delete')->render();?>
<script src="{{ asset('js/privilege/role/role.js') }}" type="text/javascript"></script>
{{--<script src="{{ asset('js/privilege/role/mobile_type.js') }}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('js/privilege/role/group.js') }}" type="text/javascript"></script>--}}
<script src="{{ asset('js/privilege/role/static.js') }}" type="text/javascript"></script>
<link href="{{ asset('css/privilege/role.css') }}" rel="stylesheet" type="text/css" />
<?php echo view('share.footer')->render() ?>
