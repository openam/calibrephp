<div class="tags view">
	<h2><?php  echo $tag['Tag']['name']; ?></h2>
</div>

<h3><?php echo __('Related Books'); ?></h3>

<?php
	foreach ($tag['Book'] as $key => $book) {
		echo $this->element('bookInfo', array(
			'book'    => $book,
			'exclude' => array('Tag')
		));
	}

	echo $this->Image->fancyboxJs();
?>
