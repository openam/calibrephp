<div class="authors view">
<h2><?php  echo __('Author'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($author['Author']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($author['Author']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sort'); ?></dt>
		<dd>
			<?php echo h($author['Author']['sort']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Link'); ?></dt>
		<dd>
			<?php echo h($author['Author']['link']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Author'), array('action' => 'edit', $author['Author']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Author'), array('action' => 'delete', $author['Author']['id']), null, __('Are you sure you want to delete # %s?', $author['Author']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Authors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Author'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Books'), array('controller' => 'books', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Books'); ?></h3>
	<?php if (!empty($author['Book'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Sort'); ?></th>
		<th><?php echo __('Timestamp'); ?></th>
		<th><?php echo __('Pubdate'); ?></th>
		<th><?php echo __('Series Index'); ?></th>
		<th><?php echo __('Author Sort'); ?></th>
		<th><?php echo __('Isbn'); ?></th>
		<th><?php echo __('Lccn'); ?></th>
		<th><?php echo __('Path'); ?></th>
		<th><?php echo __('Flags'); ?></th>
		<th><?php echo __('Uuid'); ?></th>
		<th><?php echo __('Has Cover'); ?></th>
		<th><?php echo __('Last Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($author['Book'] as $book): ?>
		<tr>
			<td><?php echo $book['id']; ?></td>
			<td><?php echo $book['title']; ?></td>
			<td><?php echo $book['sort']; ?></td>
			<td><?php echo $book['timestamp']; ?></td>
			<td><?php echo $book['pubdate']; ?></td>
			<td><?php echo $book['series_index']; ?></td>
			<td><?php echo $book['author_sort']; ?></td>
			<td><?php echo $book['isbn']; ?></td>
			<td><?php echo $book['lccn']; ?></td>
			<td><?php echo $book['path']; ?></td>
			<td><?php echo $book['flags']; ?></td>
			<td><?php echo $book['uuid']; ?></td>
			<td><?php echo $book['has_cover']; ?></td>
			<td><?php echo $book['last_modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'books', 'action' => 'view', $book['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'books', 'action' => 'edit', $book['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'books', 'action' => 'delete', $book['id']), null, __('Are you sure you want to delete # %s?', $book['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Book'), array('controller' => 'books', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
