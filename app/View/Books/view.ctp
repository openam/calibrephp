<div class="books view">
	<?php
		echo $this->Image->fancybox($book['Book'], array('thumbnail' => 'view'));
	?>

	<div class="book-row">
		<?php echo $this->Image->ebookLinks($book['Datum'], 'btn-group pull-right hidden-phone'); ?>
		<h3><?php  echo h($book['Book']['sort']); ?></h3>
		<?php
			echo $this->Txt->definition(array(__('Author')    => $this->Txt->habtmLinks($book['Author'], 'authors')));
			echo $this->Txt->definition(array(__('Series')    => $this->Txt->habtmLinks($book['Series'], 'series')));
			echo $this->Txt->definition(array(__('Year')      => $this->Time->format('Y', $book['Book']['pubdate'])));
			echo $this->Txt->definition(array(__('Rating')    => $this->Txt->rating($book['Rating'])));
			echo $this->Txt->identifiers($book['Identifier']);
			echo $this->Txt->definition(array(__('Publisher') => $this->Txt->habtmLinks($book['Publisher'], 'publishers')));
			echo $this->Txt->definition(array(__('Tags')      => $this->Txt->habtmLinks($book['Tag'], 'tags')));
			echo $this->Txt->definition(array(__('Format')    => $this->Txt->fileTypes($book['Datum'])));
		?>
	</div>
	<?php echo $this->Image->ebookLinks($book['Datum'], 'btn-group visible-phone'); ?>
</div>
<div>
	<?php if (!empty($book['Comment']['text'])): ?>
		<hr />
		<h4>Summary Information</h4>
			<?php
				echo $book['Comment']['text'];
			?>
		<hr />
	<?php endif; ?>
</div>

<?php echo $this->Image->fancyboxJs(); ?>
