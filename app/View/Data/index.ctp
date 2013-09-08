<div class="data index">
	<h2><?php echo __('Formats'); ?></h2>
	<ul class="list-group">
		<?php foreach ($datum as $data): ?>
			<li class="list-group-item">
				<?php echo $this->Html->link($data, array('controller' => 'formats', 'action' => 'view', strtolower($data))); ?>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
