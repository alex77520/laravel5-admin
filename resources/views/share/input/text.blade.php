<?php
$class = isset($class) ? $class : '';
$label = isset($label) ? $label : '';
$value = isset($value) ? $value : '';
$id = isset($id) ? $id : '';
$name = isset($name) ? $name : '';
$disabled = isset($disabled) ? $disabled : '';
$attrs = '';
$required = isset($required) && $required ? 1 : 0;
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
		<input name='<?php echo $name;?>' type="text" id="<?php echo $id;?>" value="<?php echo $value;?>" class="<?php echo $class;?>" <?php echo $attrs;?> <?php if ($disabled) echo "disabled=\"$disabled\""?>>
		<span class="help-inline"><?php if($required) echo '<font color="red">*</font>';?></span>
	</div>
	<div class="col-sm-1"></div>
</div>
