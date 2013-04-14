<div class="authors index">
	<h2><?php echo __('Authors'); ?></h2>
	<table class="table">
		<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('sort', 'Sort order'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($authors as $author): ?>
			<tr>
				<td><?php echo h($author['Author']['name']); ?></td>
				<td><?php echo h($author['Author']['sort']); ?></td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $author['Author']['id']), array('class' => 'btn')); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php echo $this->element('Paginator/footer'); ?>
</div>