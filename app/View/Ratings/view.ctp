<div class="ratings view">
	<h2><?php echo $this->Txt->stars($rating['Rating']['rating'] / 2); ?> Rating</h2>
</div>

<?php if ($rating['Rating']['rating'] == 0): ?>
	<p>These books have been listed as <?php echo str_repeat('&#9734;', 5); ?>. They probably just have not been given a rating.</p>
<?php endif ?>

<h3>Related Books</h3>
<?php foreach ($rating['Book'] as $key => $book): ?>
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
			echo $this->Txt->definition(array(__('Author') => $this->Txt->habtmLinks($book['Author'])));
			echo $this->Txt->definition(array(__('Series') => $this->Txt->habtmLinks($book['Series'], 'series')));
			echo $this->Txt->definition(array(__('Year') => $this->Time->format('Y', $book['pubdate'])));
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