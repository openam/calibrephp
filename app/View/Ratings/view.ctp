<div class="ratings view">
	<h2><?php echo $this->Txt->stars($rating['Rating']['rating'] / 2); ?> Rating</h2>
</div>

<?php if ($rating['Rating']['rating'] == 0): ?>
	<p>These books have been listed as <?php echo str_repeat('&#9734;', 5); ?>. They probably just have not been given a rating.</p>
<?php endif ?>

<h3>Related Books</h3>

<?php
	foreach ($rating['Book'] as $key => $book) {
		echo $this->element('bookInfo', array(
			'book'    => $book,
			'exclude' => array('Rating')
		));
	}

	echo $this->Image->fancyboxJs();
?>
