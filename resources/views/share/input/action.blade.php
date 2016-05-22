<?php 
if (!isset($btn)) return false;
if (!is_array($btn)) return false;
if (count($btn) == 0) return false;
?>
<!--div class="form-actions"-->
<?php foreach ($btn as $b):?>
<?php
$attr = array();
foreach ($b['attr'] as $k => $v) {
	$attr[] = "$k='{$v}'";
}
$attrs = implode(' ', $attr);
?>
<button type='<?php echo $b['type'];?>'  <?php echo $attrs;?>><?php echo $b['text'];?></button>
<?php endforeach;?>
<!--/div-->
