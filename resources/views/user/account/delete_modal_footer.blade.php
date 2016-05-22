</div>
<div class="modal-footer">
<?php echo view('share.input.action')
	->with('btn', array(
		array('type' => 'submit','text'=>'确定', 'attr' => array('class'=>'btn btn-danger', )),
		array('type' => 'reset','text'=>'取消', 'attr' => array('class'=>'btn', 'data-dismiss'=>'modal')),
		))
	->render();?>
</div>
</form>