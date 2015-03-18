<div class="publishers index">
	<h2><?php echo __('Publishers'); ?></h2>
	<?php echo $this->element('search'); ?>
	<div>
		<ul class="nav nav-pills">
			<li class="disabled"><a href="#"><?php echo __('Sort By'); ?>:</a></li>
			<?php
				echo $this->Txt->paginateSort('name', __('Name'));
			?>
		</ul>
	</div>

	<ul class="list-group">
		<?php foreach ($publishers as $publisher): ?>
			<li class="list-group-item">
				<span class="badge"><?php echo $info['Publisher'][$publisher['Publisher']['id']]['count']; ?></span>
				<?php echo $this->Html->link($publisher['Publisher']['name'], array('action' => 'view', $publisher['Publisher']['id']), array()); ?>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php echo $this->element('Paginator/footer'); ?>
</div>
