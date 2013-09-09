<div class="books index">
	<h2><?php echo __('Books'); ?></h2>
	<div>
		<ul class="nav nav-pills">
			<li class="disabled"><a href="#">Sort By:</a></li>
			<?php
				echo $this->Txt->paginateSort('timestamp', 'Date Added');
				echo $this->Txt->paginateSort('author_sort', 'Author');
				echo $this->Txt->paginateSort('sort', 'Title');
				echo $this->Txt->paginateSort('series_index');
			?>
		</ul>
	</div>

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
