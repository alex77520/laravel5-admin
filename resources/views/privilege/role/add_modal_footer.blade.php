</div>
<div class="modal-footer">
<?php echo view('share.input.action')
	->with('btn', array(
		array('type' => 'submit','text'=>'保存', 'attr' => array('class'=>'btn btn-primary')),
		array('type' => 'reset','text'=>'清空', 'attr' => array('class'=>'btn')),
		))
	->render();?>
</div>
</form>