<?php echo view('share.header')->with('nav', Session::get('nav', array()))->with('moduleActions', Session::get('moduleActions', array()))->with('action', $action)->render() ?>
<fieldset>
	<?php echo view('share.legend')->with('action', $action->action_cn)->with('start_page', $action->module.'#'.$action->action)->render();?>
	<div class="alert" style='background-color:white;margin-top:-20px;'>
		<h4 class="alert-heading" style='display:inline;'>组列表</h4>
		<br /><br />
		<?php echo view('user.group.result')
			->with('groups', $groups)
			->render();?>
	</div>
</fieldset>
<?php echo view('user.group.add');?>
<?php echo view('user.group.edit');?>
<?php echo view('user.group.delete');?>
<?php echo view('user.group.join');?>
<?php echo view('user.group.depart');?>

<script src="{{ asset('js/user/group/lead_group.js') }}" type="text/javascript"></script>
<link href="{{ asset('css/user/account.css') }}" rel="stylesheet" type="text/css" />
<?php echo view('share.footer')->render() ?>
