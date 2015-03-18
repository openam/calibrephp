<div class="ratings view">
	<h2><?php echo $this->Txt->stars($rating['Rating']['rating'] / 2) . ' ' . __('Rating'); ?></h2>
</div>

<?php if ($rating['Rating']['rating'] == 0): ?>
	<p><?php echo __('These books have been listed as %s. They probably just have not been given a rating.', str_repeat('&#9734;', 5)); ?></p>
<?php endif ?>

<h3><?php echo __('Related Books'); ?></h3>

<?php
	foreach ($rating['Book'] as $key => $book) {
		echo $this->element('bookInfo', array(
			'book'    => $book,
			'exclude' => array('Rating')
		));
	}

	echo $this->Image->fancyboxJs();
?>
