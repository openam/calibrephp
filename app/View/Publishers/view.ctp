<div class="publishers view">
	<h2><?php  echo ($publisher['Publisher']['name']); ?></h2>
</div>

<h3>Related Books</h3>
<?php foreach ($publisher['Book'] as $key => $book): ?>
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
			echo $this->Txt->definition(array(__('Rating') => $this->Txt->rating($book['Rating'])));
			echo $this->Txt->definition(array(__('Tags') => $this->Txt->habtmLinks($book['Tag'], 'tags')));
		?>
	</div>
<?php endforeach; ?>

<?php echo $this->Image->fancyboxJs(); ?>