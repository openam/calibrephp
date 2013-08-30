<div class="books index">
	<h2><?php echo __('Books'); ?></h2>
	<div>
		<ul class="nav nav-pills nav-justified">
			<li class="disabled"><a href="#">Sort By:</a></li>
			<li><?php echo $this->Paginator->sort('sort', 'Title'); ?></li>
			<li><?php echo $this->Paginator->sort('author_sort', 'Author'); ?></li>
			<li><?php echo $this->Paginator->sort('series_index'); ?></li>
		</ul>
	</div>

	<div class="clearfix"><br /></div>

	<?php
		foreach ($books as $key => $book) {
			echo $this->element('bookInfo', array(
				'book'    => $book,
				'exclude' => array()
			));
		}

		echo $this->element('Paginator/footer');
	?>
</div>

<?php echo $this->Image->fancyboxJs(); ?>
