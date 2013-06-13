<div class="authors view">
	<h2><?php  echo h($author['Author']['name']); ?></h2>
</div>

<h3>Related Series</h3>
<?php
	if (!empty($series)) {
		foreach ($series as $key => $value) {
			echo $this->Html->link($key, array('controller' => 'series', 'action' => 'view', $value));
		}
	} else {
		echo "No series";
	}
?>

<h3>Related Books</h3>

<?php
	foreach ($author['Book'] as $key => $book) {
		echo $this->element('bookInfo', array(
			'book'    => $book,
			'exclude' => array('Author')
		));
	}

	echo $this->Image->fancyboxJs();
?>
