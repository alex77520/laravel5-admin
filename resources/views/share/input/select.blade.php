<?php
$class = isset($class) ? $class : '';
$label = isset($label) ? $label : '';
$value = isset($value) ? $value : '';
$id = isset($id) ? $id : '';
$name = isset($name) ? $name : '';
$required = isset($required) && $required ? 1 : 0;
$attrs = '';
if (isset($opt) and is_array($opt)) {
	$attr = array();
	foreach ($opt as $k => $v) {
		$attr[] = "{$k}='{$v}'";
	}
	$attrs = implode(' ', $attr);
}
$kv = isset($kv) ? $kv : array();
$kv = is_array($kv) ? $kv : array();
$selected = isset($selected) ? $selected : '';
$_display = isset($display) ? $display : 'block';
$display = 'display: '.$_display;
$placeholder = isset($placeholder) ? TRUE : FALSE;
?>
<div class="form-group" style="<?php echo $display;?>">
	<div class="col-sm-1"></div>
	<label class="col-sm-3 control-label" for="<?php echo $name;?>"><?php echo $label;?></label>
	<div class="col-sm-7">
		<select id="<?php echo $id;?>" class='<?php echo $class;?>' name="<?php echo $name;?>" <?php echo $attrs;?>>
			<?php if ($placeholder) echo "<option value=''></option>"; ?>
			<?php foreach ($kv as $k => $v):?>
			<?php if ($v != ''):?>
			<option value="<?php echo $k;?>" <?php if ($k ==  $selected) echo "selected=\"selected\"";?>><?php echo $v;?></option>
			<?php endif;?>
			<?php endforeach;?>
		</select>
		 <span class="help-inline"><?php if($required) echo '<font color="red">*</font>';?></span>
	</div>
	<div class="col-sm-1"></div>
</div>
