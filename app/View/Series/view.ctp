<div class="series view">
	<h2><?php  echo $series['Series']['name']; ?></h2>
</div>

<h3>Related Books</h3>
<?php foreach ($series['Book'] as $key => $book): ?>
	<div class="book-row">
		<?php if ($book['has_cover']): ?>
			<a class="fancybox" href="<?php echo $this->Image->resizeUrl($book['path'], $this->Image->resizeSettings['fancybox']); ?>" data-fancybox-group="gallery" title="<?php echo $book['sort']; ?>">
				<?php echo $this->Image->thumbnail($book['path'], 'index'); ?>
			</a>
		<?php else: ?>
			<span class="img-rounded pull-left cover">No Cover</span>
		<?php endif; ?>
		<?php echo $this->Image->ebookLinks($book['path'], $book['Datum'], 'btn-group btn-group-vertical pull-right'); ?>
		<div>
			<h5><?php echo $this->Html->link($book['sort'], array('controller'=>'books', 'action'=>'view', $book['id'])); ?></h5>
		</div>
		<?php
			echo $this->Txt->definition(array(__('Author') => $this->Txt->habtmLinks($book['Author'], 'authors')));
			echo $this->Txt->definition(array(__('Year') => $this->Time->format('Y', $book['pubdate'])));
			echo $this->Txt->definition(array(__('Rating') => $this->Txt->rating($book['Rating'])));
			echo $this->Txt->definition(array(__('Publisher') => $this->Txt->habtmLinks($book['Publisher'], 'publishers')));
			echo $this->Txt->definition(array(__('Tags') => $this->Txt->habtmLinks($book['Tag'], 'tags')));
		?>
	</div>
<?php endforeach; ?>

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