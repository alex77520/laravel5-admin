<?php echo view('share.header')->with('nav', Session::get('nav', array()))->with('moduleActions', Session::get('moduleActions', array()))->with('action', $action)->render() ?>

<form action="{{url($action->module.'/set'.$action->action)}}" method="POST" class="form-horizontal" id="changepw-form">
	<fieldset>
		<?php echo View::make('share.legend')->with('action', $action->action_cn)->with('start_page', $action->module.'#'.$action->action)->render();?>
		<div class="alert" style='background-color:white;margin-top:-10px;'>
			<h4 class="alert-heading" style='display:inline;'>修改密码:</h4>
			<?php echo view('share.input.text')
				->with('label', '用户名')
				->with('name', 'username')
				->with('id', 'username')
				->with('value', $user->username)
				->with('class', 'form-control')
				->with('opt', array('disabled'=>'disabled'))
				->render();?>

			<?php echo view('share.input.password')
				->with('label', '原密码')
				->with('name', 'oldpassword')
				->with('id', 'oldpassword')
					->with('class', 'form-control')
				->render();?>

			<?php echo view('share.input.password')
				->with('label', '新密码')
				->with('name', 'newpassword')
				->with('id', 'newpassword')->with('class', 'form-control')
				->render();?>

			<?php echo view('share.input.password')
				->with('label', '确认密码')
				->with('name', 'confirmpassword')
				->with('id', 'confirmpassword')->with('class', 'form-control')
				->render();?>
			<div class="text-center">
			<?php echo view('share.input.action')
				->with('btn', array(
					array('type' => 'submit','text'=>'保存', 'attr' => array('class'=>'btn btn-primary')),
					array('type' => 'reset','text'=>'重置', 'attr' => array('class'=>'btn')),
				))->render();?>
			</div>
		</div>
	</fieldset>
</form>

<link href="{{ asset('css/personal/profile.css') }}" rel="stylesheet" type="text/css" />
<script src="{{ asset('js/personal/personal.js') }}" type="text/javascript"></script>
<?php echo view('share.footer')->render() ?>
