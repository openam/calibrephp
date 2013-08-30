<div class="book-row">
	<?php
		if (!isset($exclude)) {
			$exclude = array();
		}

		$bookClass = isset($book['Book']) ? $book['Book'] : $book ;

		echo $this->Image->fancybox($bookClass);
		echo $this->Image->ebookLinks($book['Datum'], 'btn-toolbar pull-right hidden-xs');
	?>
	<div>
		<h4><?php echo $this->Html->link($bookClass['sort'], array('controller'=>'books', 'action'=>'view', $bookClass['id'])); ?></h4>
	</div>
	<?php
		echo $this->Txt->definitionStart();

		if (!in_array('Author', $exclude)) {
			echo $this->Txt->definition(array(__('Author')    => $this->Txt->habtmLinks($book['Author'], 'authors')));
		}

		if (!in_array('Series', $exclude)) {
			echo $this->Txt->definition(array(__('Series')    => $this->Txt->habtmLinks($book['Series'], 'series')));
		}

		if (!in_array('Year', $exclude)) {
			echo $this->Txt->definition(array(__('Year')      => $this->Time->format('Y', $bookClass['pubdate'])));
		}

		if (!in_array('Rating', $exclude)) {
			echo $this->Txt->definition(array(__('Rating')    => $this->Txt->rating($book['Rating'])));
		}

		if (!in_array('Publisher', $exclude)) {
			echo $this->Txt->definition(array(__('Publisher') => $this->Txt->habtmLinks($book['Publisher'], 'publishers')));
		}

		if (!in_array('Tag', $exclude)) {
			echo $this->Txt->definition(array(__('Tags')      => $this->Txt->habtmLinks($book['Tag'], 'tags')));
		}

		if (!in_array('Format', $exclude)) {
			$plural = count($book['Datum']) > 1 ? 's' : '';
			echo $this->Txt->definition(array(__('Format' . $plural)    => $this->Txt->fileTypes($book['Datum'])));
		}

		echo $this->Image->ebookLinks($book['Datum'], 'btn-toolbar visible-xs clearfix');

		echo $this->Txt->definitionEnd();
	?>
</div>
