<div class="authors view">
	<h2><?php  echo h($author['Author']['name']); ?></h2>
</div>

<?php if (!empty($series)): ?>
	<h3><?php echo __('Related Series'); ?></h3>
	<ul class="list-group">
			<?php foreach ($series as $key => $value): ?>
				<li class="list-group-item">
					<!-- <span class="badge"><?php echo $info['Tag'][$tag['Tag']['id']]['count']; ?></span> -->
					<?php echo $this->Html->link($key, array('controller' => 'series', 'action' => 'view', $value)); ?>
				</li>
			<?php endforeach; ?>
	</ul>
<?php endif; ?>

<h3><?php echo __('Related Books'); ?></h3>

<?php
	foreach ($author['Book'] as $key => $book) {
		echo $this->element('bookInfo', array(
			'book'    => $book,
			'exclude' => array('Author')
		));
	}

	echo $this->Image->fancyboxJs();
?>
