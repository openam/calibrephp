<div class="publishers view">
	<h2><?php  echo ($publisher['Publisher']['name']); ?></h2>
</div>

<h3><?php echo __('Related Books'); ?></h3>

<?php
	foreach ($publisher['Book'] as $key => $book) {
		echo $this->element('bookInfo', array(
			'book'    => $book,
			'exclude' => array('Publisher')
		));
	}

	echo $this->Image->fancyboxJs();
?>
