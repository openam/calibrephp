<div class="books view">
<h2><?php  echo __('Book'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($book['Book']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($book['Book']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sort'); ?></dt>
		<dd>
			<?php echo h($book['Book']['sort']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Timestamp'); ?></dt>
		<dd>
			<?php echo h($book['Book']['timestamp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pubdate'); ?></dt>
		<dd>
			<?php echo h($book['Book']['pubdate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Series'); ?></dt>
		<dd>
			<?php echo $this->Html->link($book['Series']['name'], array('controller' => 'series', 'action' => 'view', $book['Series']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Author Sort'); ?></dt>
		<dd>
			<?php echo h($book['Book']['author_sort']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Isbn'); ?></dt>
		<dd>
			<?php echo h($book['Book']['isbn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lccn'); ?></dt>
		<dd>
			<?php echo h($book['Book']['lccn']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Path'); ?></dt>
		<dd>
			<?php echo h($book['Book']['path']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Flags'); ?></dt>
		<dd>
			<?php echo h($book['Book']['flags']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Uuid'); ?></dt>
		<dd>
			<?php echo h($book['Book']['uuid']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Has Cover'); ?></dt>
		<dd>
			<?php echo h($book['Book']['has_cover']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Modified'); ?></dt>
		<dd>
			<?php echo h($book['Book']['last_modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Book'), array('action' => 'edit', $book['Book']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Book'), array('action' => 'delete', $book['Book']['id']), null, __('Are you sure you want to delete # %s?', $book['Book']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Books'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Book'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Series'), array('controller' => 'series', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Series'), array('controller' => 'series', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('controller' => 'comments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('controller' => 'comments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Data'), array('controller' => 'data', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Datum'), array('controller' => 'data', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Authors'), array('controller' => 'authors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Author'), array('controller' => 'authors', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Publishers'), array('controller' => 'publishers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Publisher'), array('controller' => 'publishers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ratings'), array('controller' => 'ratings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rating'), array('controller' => 'ratings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php echo __('Related Comments'); ?></h3>
	<?php if (!empty($book['Comment'])): ?>
		<dl>
			<dt><?php echo __('Id'); ?></dt>
		<dd>
	<?php echo $book['Comment']['id']; ?>
&nbsp;</dd>
		<dt><?php echo __('Book'); ?></dt>
		<dd>
	<?php echo $book['Comment']['book']; ?>
&nbsp;</dd>
		<dt><?php echo __('Text'); ?></dt>
		<dd>
	<?php echo $book['Comment']['text']; ?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Edit Comment'), array('controller' => 'comments', 'action' => 'edit', $book['Comment']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php echo __('Related Data'); ?></h3>
	<?php if (!empty($book['Datum'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Book'); ?></th>
		<th><?php echo __('Format'); ?></th>
		<th><?php echo __('Uncompressed Size'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($book['Datum'] as $datum): ?>
		<tr>
			<td><?php echo $datum['id']; ?></td>
			<td><?php echo $datum['book']; ?></td>
			<td><?php echo $datum['format']; ?></td>
			<td><?php echo $datum['uncompressed_size']; ?></td>
			<td><?php echo $datum['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'data', 'action' => 'view', $datum['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'data', 'action' => 'edit', $datum['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'data', 'action' => 'delete', $datum['id']), null, __('Are you sure you want to delete # %s?', $datum['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Datum'), array('controller' => 'data', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Authors'); ?></h3>
	<?php if (!empty($book['Author'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Sort'); ?></th>
		<th><?php echo __('Link'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($book['Author'] as $author): ?>
		<tr>
			<td><?php echo $author['id']; ?></td>
			<td><?php echo $author['name']; ?></td>
			<td><?php echo $author['sort']; ?></td>
			<td><?php echo $author['link']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'authors', 'action' => 'view', $author['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'authors', 'action' => 'edit', $author['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'authors', 'action' => 'delete', $author['id']), null, __('Are you sure you want to delete # %s?', $author['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Author'), array('controller' => 'authors', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Publishers'); ?></h3>
	<?php if (!empty($book['Publisher'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Sort'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($book['Publisher'] as $publisher): ?>
		<tr>
			<td><?php echo $publisher['id']; ?></td>
			<td><?php echo $publisher['name']; ?></td>
			<td><?php echo $publisher['sort']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'publishers', 'action' => 'view', $publisher['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'publishers', 'action' => 'edit', $publisher['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'publishers', 'action' => 'delete', $publisher['id']), null, __('Are you sure you want to delete # %s?', $publisher['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Publisher'), array('controller' => 'publishers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Ratings'); ?></h3>
	<?php if (!empty($book['Rating'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Rating'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($book['Rating'] as $rating): ?>
		<tr>
			<td><?php echo $rating['id']; ?></td>
			<td><?php echo $rating['rating']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'ratings', 'action' => 'view', $rating['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'ratings', 'action' => 'edit', $rating['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ratings', 'action' => 'delete', $rating['id']), null, __('Are you sure you want to delete # %s?', $rating['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Rating'), array('controller' => 'ratings', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Tags'); ?></h3>
	<?php if (!empty($book['Tag'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($book['Tag'] as $tag): ?>
		<tr>
			<td><?php echo $tag['id']; ?></td>
			<td><?php echo $tag['name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'tags', 'action' => 'view', $tag['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'tags', 'action' => 'edit', $tag['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'tags', 'action' => 'delete', $tag['id']), null, __('Are you sure you want to delete # %s?', $tag['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
