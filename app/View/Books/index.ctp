<div class="books index">
	<h2><?php echo __('Books'); ?></h2>
	<div>
		<ul class="nav nav-list">
			<li class="nav-header">Sort By</li>
			<li><?php echo $this->Paginator->sort('sort', 'Title'); ?></li>
			<li><?php echo $this->Paginator->sort('author_sort', 'Author'); ?></li>
			<li><?php echo $this->Paginator->sort('series_index'); ?></li>
		</ul>
	</div>

	<div class="clearfix"><br /></div>

	<?php foreach ($books as $key => $book): ?>
		<div class="book-row">
			<?php if ($book['Book']['has_cover']): ?>
				<a class="fancybox" href="<?php echo $this->Image->resizeUrl($book['Book']['path'], $this->Image->resizeSettings['fancybox']); ?>" data-fancybox-group="gallery" title="<?php echo $book['Book']['sort']; ?>">
					<?php echo $this->Image->thumbnail($book['Book']['path'], 'index'); ?>
				</a>
			<?php else: ?>
				<span class="img-rounded pull-left cover">No Cover</span>
			<?php endif; ?>
			<div class="btn-group btn-group-vertical pull-right">
				<?php foreach ($book['Datum'] as $file): ?>
					<button type="button" class="btn"><?php echo $this->Html->link($file['format'], $this->Html->url(DS . 'calibre-library' . DS . $book['Book']['path'] . DS . $file['name'] . '.' . strtolower($file['format']), true)); ?></button>
				<?php endforeach; ?>
			</div>
			<div>
				<h5><?php echo $this->Html->link($book['Book']['sort'], array('controller'=>'books', 'action'=>'view', $book['Book']['id'])); ?></h5>
			</div>
			<?php
				echo $this->Txt->definition(array(__('Author') => h($book['Book']['author_sort'])));
				if (!empty($book['Series'])) {
					echo $this->Txt->definition(array(__('Series') => $this->Html->link($book['Series'][0]['name'], array('controller' => 'series', 'action' => 'view', $book['Series'][0]['id']))));
				}
				echo $this->Txt->definition(array(__('Tags') => h(implode(', ', Set::extract('/Tag/name', $book)))));
				echo $this->Txt->definition(array(__('Language') => h('')));
			?>
		</div>
	<?php endforeach; ?>
	<?php echo $this->element('Paginator/footer'); ?>
</div>
<script type="text/javascript">
	console.log('variable');
	$(document).ready(function() {
		$(".fancybox").fancybox({
			helpers: {
				title : null
			}
		});
	});
</script>