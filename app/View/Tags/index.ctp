<div class="tags index">
	<h2><?php echo __('Tags'); ?></h2>
	<div>
		<ul class="nav nav-pills">
			<li class="disabled"><a href="#">Sort By:</a></li>
			<li><?php echo $this->Paginator->sort('name'); ?></li>
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
