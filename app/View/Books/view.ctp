<div class="books view">
	<div>
		<?php echo $this->Image->thumbnail($book['Book']['path'], 'view'); ?>
	</div>
	<div class="book-row">
		<div class="btn-group btn-group-vertical pull-right hidden-phone">
			<?php foreach ($book['Datum'] as $file): ?>
				<button type="button" class="btn"><?php echo $this->Html->link($file['format'], $this->Html->url(DS . 'calibre-library' . DS . $book['Book']['path'] . DS . $file['name'] . '.' . strtolower($file['format']), true)); ?></button>
			<?php endforeach; ?>
		</div>
		<h3><?php  echo h($book['Book']['sort']); ?></h3>
		<?php
			echo $this->Txt->definition(array(__('Author') => $this->Txt->habtmLinks($book['Author'], 'authors')));
			echo $this->Txt->definition(array(__('Series') => $this->Txt->habtmLinks($book['Series'], 'series')));
			echo $this->Txt->definition(array(__('Year') => $this->Time->format('Y', $book['Book']['pubdate'])));
			echo $this->Txt->definition(array(__('Rating') => $this->Txt->rating($book['Rating'])));
			echo $this->Txt->definition(array(__('Publisher') => $this->Txt->habtmLinks($book['Publisher'], 'publishers')));
			echo $this->Txt->definition(array(__('Tags') => $this->Txt->habtmLinks($book['Tag'], 'tags')));
		?>
	</div>
	<div class="btn-group  visible-phone">
		<?php foreach ($book['Datum'] as $file): ?>
			<button type="button" class="btn"><?php echo $this->Html->link($file['format'], $this->Html->url(DS . 'calibre-library' . DS . $book['Book']['path'] . DS . $file['name'] . '.' . strtolower($file['format']), true)); ?></button>
		<?php endforeach; ?>
	</div>
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