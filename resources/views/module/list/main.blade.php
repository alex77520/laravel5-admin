<?php echo view('share.header')->with('nav', Session::get('nav', array()))->with('moduleActions', Session::get('moduleActions', array()))->with('action', $action)->render() ?>
<fieldset>
	<?php echo view('share.legend')->with('action', $action->action_cn)->with('start_page', $action->module.'#'.$action->action)->render();?>
	<div class="alert" style='background-color:white;margin-top:-20px;'>
	<?php echo view('module.list.cond')
		->with('modules', $modulesGroup)
		->render();
	?>
	<?php echo view('module.list.result')
		->with('modules', $modules)
		->render();?>
	</div>
</fieldset>
<?php echo view('module.list.add')?>
<?php echo view('module.list.edit')?>
<?php echo view('module.list.delete');?>

<?php echo view('share.footer')->render() ?>
