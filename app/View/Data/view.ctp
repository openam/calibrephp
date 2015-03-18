<div class="datum view">
	<h2><?php  echo ($datum['Datum']['name']); ?></h2>
</div>

<h3><?php echo __('Related Books'); ?></h3>

<?php
	foreach ($datum['Book'] as $key => $book) {
		echo $this->element('bookInfo', array(
			'book'    => $book,
		));
	}

	echo $this->element('Paginator/footer');
	echo $this->Image->fancyboxJs();
?>

