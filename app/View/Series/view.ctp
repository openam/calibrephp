<div class="series view">
	<h2><?php  echo $series['Series']['name']; ?></h2>
</div>

<h3>Related Books</h3>

<?php
	foreach ($series['Book'] as $key => $book) {
		echo $this->element('bookInfo', array(
			'book'    => $book,
			'exclude' => array('Series')
		));
	}

	echo $this->Image->fancyboxJs();
?>
