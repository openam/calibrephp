<div class="books view">
	<div class="center">
		<?php echo $this->Image->fancybox($book['Book'], array('thumbnail' => 'view')); ?>
	</div>

	<div class="book-row">
		<?php echo $this->Image->ebookLinks($book['Datum'], 'btn-toolbar pull-right hidden-xs'); ?>
		<div>
			<h3><?php  echo h($book['Book']['sort']); ?></h3>
		</div>
		<?php
			echo $this->Txt->definitionStart();

			echo $this->Txt->definition(array(__('Author')    => $this->Txt->habtmLinks($book['Author'], 'authors')));
			echo $this->Txt->definition(array(__('Series')    => $this->Txt->habtmLinks($book['Series'], 'series')));
			echo $this->Txt->definition(array(__('Year')      => $this->Time->format('Y', $book['Book']['pubdate'])));
			echo $this->Txt->definition(array(__('Rating')    => $this->Txt->rating($book['Rating'])));
			echo $this->Txt->identifiers($book['Identifier']);
			echo $this->Txt->definition(array(__('Publisher') => $this->Txt->habtmLinks($book['Publisher'], 'publishers')));
			echo $this->Txt->definition(array(__('Tags')      => $this->Txt->habtmLinks($book['Tag'], 'tags')));
			$plural = count($book['Datum']) > 1 ? 's' : '';
			echo $this->Txt->definition(array(__('Format' . $plural)    => $this->Txt->fileTypes($book['Datum'])));
			echo $this->Image->ebookLinks($book['Datum'], 'visible-xs', 'pull-left');

			echo $this->Txt->definitionEnd();

		?>
	</div>
</div>
<div>
	<?php if (!empty($book['Comment']['text'])): ?>
		<hr />
		<h4><?php echo __('Summary Information'); ?></h4>
			<?php
				echo $book['Comment']['text'];
			?>
		<hr />
	<?php endif; ?>
</div>

<?php echo $this->Image->fancyboxJs(); ?>
