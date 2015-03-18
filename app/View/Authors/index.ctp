<div class="authors index">
	<h2><?php echo __('Authors'); ?></h2>
	<div>
		<ul class="nav nav-pills">
			<li class="disabled"><a href="#"><?php echo __('Sort By'); ?>:</a></li>
			<?php
				echo $this->Txt->paginateSort('name', __('Name'));
				echo $this->Txt->paginateSort('sort', __('Last Name'));
			?>
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
