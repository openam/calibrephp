<div class="authors view">
	<h2><?php  echo h($author['Author']['name']); ?></h2>
</div>

<h3>Related Series</h3>
<?php
	if (!empty($series)) {
		foreach ($series as $key => $value) {
			echo $this->Html->link($key, array('controller' => 'series', 'action' => 'view', $value));
		}
	} else {
		echo "No series";
	}
?>

<h3>Related Books</h3>
<?php foreach ($author['Book'] as $key => $book): ?>
	<div class="book-row">
		<?php
			echo $this->Image->fancybox($book);
			echo $this->Image->ebookLinks($book['Datum'], 'btn-group btn-group-vertical pull-right');
		?>
		<div>
			<h5><?php echo $this->Html->link($book['sort'], array('controller'=>'books', 'action'=>'view', $book['id'])); ?></h5>
		</div>
		<?php
			echo $this->Txt->definition(array(__('Series')    => $this->Txt->habtmLinks($book['Series'], 'series')));
			echo $this->Txt->definition(array(__('Year')      => $this->Time->format('Y', $book['pubdate'])));
			echo $this->Txt->definition(array(__('Rating')    => $this->Txt->rating($book['Rating'])));
			echo $this->Txt->definition(array(__('Publisher') => $this->Txt->habtmLinks($book['Publisher'], 'publishers')));
			echo $this->Txt->definition(array(__('Tags')      => $this->Txt->habtmLinks($book['Tag'], 'tags')));
			echo $this->Txt->definition(array(__('Format')    => $this->Txt->fileTypes($book['Datum'])));
		?>
	</div>
<?php endforeach; ?>

<?php echo $this->Image->fancyboxJs(); ?>
