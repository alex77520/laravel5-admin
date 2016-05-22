<?php echo view('share.header')->with('nav', Session::get('nav', array()))->with('moduleActions', Session::get('moduleActions', array()))->with('action', $action)->render() ?>
<fieldset>
	<?php echo view('share.legend')->with('action', $action->action_cn)->with('start_page', $action->module.'#'.$action->action)->render();?>
	<div class="alert" style='background-color:white;margin-top:-20px;'>
		<h4 class="alert-heading" style='display:inline;'>用户列表</h4>
		<br /><br />
		<?php echo view('user.account.result')
			->with('users', $users)
			->render();?>
	</div>
</fieldset>
<?php echo view('user.account.add');?>
<?php echo view('user.account.edit');?>
<?php echo view('user.account.delete');?>
<?php echo view('user.account.lock');?>
<link href="{{ asset('css/user/account.css') }}" rel="stylesheet" type="text/css" />
<?php echo view('share.footer')->render() ?>
