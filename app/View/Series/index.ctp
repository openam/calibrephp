<div class="series index">
	<h2><?php echo __('Series'); ?></h2>
	<div>
		<ul class="nav nav-pills">
			<li class="disabled"><a href="#">Sort By:</a></li>
			<li><?php echo $this->Paginator->sort('name'); ?></li>
		</ul>
	</div>
	<ul class="list-group">
		<?php foreach ($series as $serie): ?>
			<li class="list-group-item">
				<span class="badge"><?php echo $info['Series'][$serie['Series']['id']]['count']; ?></span>
				<?php echo $this->Html->link($serie['Series']['name'], array('action' => 'view', $serie['Series']['id']), array()); ?>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php echo $this->element('Paginator/footer'); ?>
</div>