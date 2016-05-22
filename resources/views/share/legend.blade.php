<legend id='right-legend'>
	<?php if (isset($perset)): ?>
	<?php if (!empty($perset['fields'])): ?>
	<div class="btn-group pull-right" style="margin-top: 6px;">
		<button class="btn btn-inverse"><?php echo $perset['current']; ?></button>
		<button class="btn btn-inverse dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
		<ul class="dropdown-menu" style="font-size: 14px;">
		<?php $n = 0; $max = count($perset['fields']); foreach ($perset['fields'] as $k => $v): ?>
			<?php $n++; ?>
			<li><a href="javascript:void(0)" class="perset" data-id="<?php echo $k; ?>"><i class="icon-hand-right"></i>&nbsp;<?php echo $v; ?></a></li>
			<?php if ($n != $max): ?>
			<li class="divider"></li>
			<?php endif; ?>
		<?php endforeach; ?>
		</ul>
	</div>
	<?php endif; ?>
	<?php endif; ?>
</legend>
