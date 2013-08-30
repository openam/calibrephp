<div class="authors index">
	<h2><?php echo __('Authors'); ?></h2>
	<div>
		<ul class="nav nav-pills">
			<li class="disabled"><a href="#">Sort By:</a></li>
			<li><?php echo $this->Paginator->sort('name'); ?></li>
			<li><?php echo $this->Paginator->sort('sort', 'Last Name'); ?></li>
		</ul>
	</div>
	<ul class="list-group">
		<?php foreach ($authors as $author): ?>
			<li class="list-group-item">
				<span class="badge"><?php echo $info['Author'][$author['Author']['id']]['count']; ?></span>
				<?php echo $this->Html->link($author['Author']['name'], array('action' => 'view', $author['Author']['id']), array()); ?>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php echo $this->element('Paginator/footer'); ?>
</div>
