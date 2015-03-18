<div class="tags index">
	<h2><?php echo __('Tags'); ?></h2>
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
		<?php foreach ($tags as $tag): ?>
			<li class="list-group-item">
				<span class="badge"><?php echo $info['Tag'][$tag['Tag']['id']]['count']; ?></span>
				<?php echo $this->Html->link($tag['Tag']['name'], array('action' => 'view', $tag['Tag']['id']), array()); ?>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php echo $this->element('Paginator/footer'); ?>
</div>
