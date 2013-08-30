<div class="series index">
	<h2><?php echo __('Series'); ?></h2>
	<table class="table">
		<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($series as $series): ?>
			<tr>
				<td><?php echo h($series['Series']['name']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $series['Series']['id']), array('class' => 'btn btn-default')); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php echo $this->element('Paginator/footer'); ?>
</div>
