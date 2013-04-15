<div class="publishers index">
	<h2><?php echo __('Publishers'); ?></h2>
	<table class="table">
		<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($publishers as $publisher): ?>
			<tr>
				<td><?php echo h($publisher['Publisher']['name']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $publisher['Publisher']['id']), array('class' => 'btn')); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php echo $this->element('Paginator/footer'); ?>
</div>