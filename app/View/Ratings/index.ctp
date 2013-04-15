<div class="ratings index">
	<h2><?php echo __('Ratings'); ?></h2>
	<table class="table">
		<tr>
			<th><?php echo $this->Paginator->sort('rating'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($ratings as $rating): ?>
			<tr>
				<td><?php echo $this->Txt->rating($rating, true); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $rating['Rating']['id']), array('class' => 'btn')); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php echo $this->element('Paginator/footer'); ?>
</div>