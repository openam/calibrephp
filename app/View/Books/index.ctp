<div class="books index">
	<h2><?php echo __('Books'); ?></h2>
	<div>
		<ul class="nav nav-pills">
			<li class="disabled"><a href="#"><?php echo __('Sort By'); ?>:</a></li>
			<?php
				echo $this->Txt->paginateSort('timestamp', __('Date Added'));
				echo $this->Txt->paginateSort('author_sort', __('Author'));
				echo $this->Txt->paginateSort('sort', __('Title'));
				echo $this->Txt->paginateSort('series_index', __('Series Index'));
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
