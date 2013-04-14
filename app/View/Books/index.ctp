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
			<?php echo $this->Image->ebookLinks($book['Book']['path'], $book['Datum'], 'btn-group btn-group-vertical pull-right'); ?>
			<div>
				<h5><?php echo $this->Html->link($book['Book']['sort'], array('controller'=>'books', 'action'=>'view', $book['Book']['id'])); ?></h5>
			</div>
			<?php
				echo $this->Txt->definition(array(__('Author') => $this->Txt->habtmLinks($book['Author'], 'authors')));
				echo $this->Txt->definition(array(__('Series') => $this->Txt->habtmLinks($book['Series'], 'series')));
				echo $this->Txt->definition(array(__('Year') => $this->Time->format('Y', $book['Book']['pubdate'])));
				echo $this->Txt->definition(array(__('Rating') => $this->Txt->rating($book['Rating'])));
				echo $this->Txt->definition(array(__('Publisher') => $this->Txt->habtmLinks($book['Publisher'], 'publishers')));
				echo $this->Txt->definition(array(__('Tags') => $this->Txt->habtmLinks($book['Tag'], 'tags')));
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