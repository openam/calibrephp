<div class="series index">
	<h2><?php echo __('Series'); ?></h2>
	<div>
		<ul class="nav nav-pills">
			<li class="disabled"><a href="#"><?php echo __('Sort By'); ?>:</a></li>
			<?php
				echo $this->Txt->paginateSort('name', __('Name'));
			?>
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
