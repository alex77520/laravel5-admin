<?php
$class = isset($class) ? $class : '';
$id = isset($id) ? $id : '';
$title = isset($title) ? $title : '';
$body = isset($body) ? $body : '';
$footer = isset($footer) ? $footer : '';

$attrs = '';
if (isset($opt) and is_array($opt)) {
	$attr = array();
	foreach ($opt as $k => $v) {
		$attr[] = "{$k}='{$v}'";
	}
	$attrs = implode(' ', $attr);
}
?>

<div class="modal fade <?php echo $class;?>" id="<?php echo $id;?>" <?php echo $attrs;?>>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button style='right:10px;' type="button" class="close" data-dismiss="modal">×</button>
				<h3 style='display:inline;'><?php echo $title;?></h3>
			</div>
			<?php echo $body;?>
			<?php echo $footer;?>
		</div>
	</div>
</div>
