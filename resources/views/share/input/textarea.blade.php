<?php
$class = isset($class) ? $class : '';
$label = isset($label) ? $label : '';
$value = isset($value) ? $value : '';
$id = isset($id) ? $id : '';
$name = isset($name) ? $name : '';
$attrs = '';
if (isset($opt) and is_array($opt)) {
	$attr = array();
	foreach ($opt as $k => $v) {
		$attr[] = "{$k}='{$v}'";
	}
	$attrs = implode(' ', $attr);
}
?>
<div class="form-group">
	<div class="col-sm-1"></div>
	<label class="col-sm-3 control-label" for="<?php echo $name;?>"><?php echo $label;?></label>
	 <div class="col-sm-7">
		<textarea rom="2" name='<?php echo $name;?>' id="<?php echo $id;?>" class="<?php echo $class;?>" <?php echo $attrs;?>><?php echo $value;?></textarea>
		<span class="help-inline"></span>
	</div><div class="col-sm-1"></div>

</div>
