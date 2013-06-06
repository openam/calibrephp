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
			<?php
				echo $this->Image->fancybox($book['Book']);
				echo $this->Image->ebookLinks($book['Datum'], 'btn-group btn-group-vertical pull-right');
			?>
			<div>
				<h5><?php echo $this->Html->link($book['Book']['sort'], array('controller'=>'books', 'action'=>'view', $book['Book']['id'])); ?></h5>
			</div>
			<?php
				echo $this->Txt->definition(array(__('Author')    => $this->Txt->habtmLinks($book['Author'], 'authors')));
				echo $this->Txt->definition(array(__('Series')    => $this->Txt->habtmLinks($book['Series'], 'series')));
				echo $this->Txt->definition(array(__('Year')      => $this->Time->format('Y', $book['Book']['pubdate'])));
				echo $this->Txt->definition(array(__('Rating')    => $this->Txt->rating($book['Rating'])));
				echo $this->Txt->definition(array(__('Publisher') => $this->Txt->habtmLinks($book['Publisher'], 'publishers')));
				echo $this->Txt->definition(array(__('Tags')      => $this->Txt->habtmLinks($book['Tag'], 'tags')));
				echo $this->Txt->definition(array(__('Format')    => $this->Txt->fileTypes($book['Datum'])));
			?>
		</div>
	<?php endforeach; ?>
	<?php echo $this->element('Paginator/footer'); ?>
</div>

<?php echo $this->Image->fancyboxJs(); ?>
