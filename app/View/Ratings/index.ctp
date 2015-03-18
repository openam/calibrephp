<div class="ratings index">
	<h2><?php echo __('Ratings'); ?></h2>
	<div>
		<ul class="nav nav-pills">
			<li class="disabled"><a href="#"><?php echo __('Sort By'); ?>:</a></li>
			<?php
				echo $this->Txt->paginateSort('rating', __('Rating'));
			?>
		</ul>
	</div>

	<ul class="list-group">
		<?php foreach ($ratings as $rating): ?>
			<li class="list-group-item">
				<span class="badge"><?php echo $info['Rating'][$rating['Rating']['id']]['count']; ?></span>
				<?php echo $this->Html->link($this->Txt->rating($rating, true), array('action' => 'view', $rating['Rating']['id']), array('escape' => false)); ?>
			</li>
		<?php endforeach; ?>
	</ul>

	<?php echo $this->element('Paginator/footer'); ?>
</div>
