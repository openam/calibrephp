<div class="ratings view">
	<h2><?php echo $this->Txt->stars($rating['Rating']['rating'] / 2); ?> Rating</h2>
</div>

<?php if ($rating['Rating']['rating'] == 0): ?>
	<p>These books have been listed as <?php echo str_repeat('&#9734;', 5); ?>. They probably just have not been given a rating.</p>
<?php endif ?>

<h3>Related Books</h3>
<?php foreach ($rating['Book'] as $key => $book): ?>
	<div class="book-row">
		<?php
			echo $this->Image->fancybox($book);
			echo $this->Image->ebookLinks($book['Datum'], 'btn-group btn-group-vertical pull-right');
		?>
		<div>
			<h5><?php echo $this->Html->link($book['sort'], array('controller'=>'books', 'action'=>'view', $book['id'])); ?></h5>
		</div>
		<?php
			echo $this->Txt->definition(array(__('Author') => $this->Txt->habtmLinks($book['Author'], 'authors')));
			echo $this->Txt->definition(array(__('Series') => $this->Txt->habtmLinks($book['Series'], 'series')));
			echo $this->Txt->definition(array(__('Year') => $this->Time->format('Y', $book['pubdate'])));
			echo $this->Txt->definition(array(__('Publisher') => $this->Txt->habtmLinks($book['Publisher'], 'publishers')));
			echo $this->Txt->definition(array(__('Tags') => $this->Txt->habtmLinks($book['Tag'], 'tags')));
		?>
	</div>
<?php endforeach; ?>

<?php echo $this->Image->fancyboxJs(); ?>