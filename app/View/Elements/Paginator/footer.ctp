<div class="clear-both paginator-footer">
	<span class="center">
		<?php
			echo $this->Paginator->counter(array(
				'format' => __('Results %s - %s of %s | Page %s of %s', '{:start}', '{:end}', '{:count}', '{:page}', '{:pages}')
			));
		?>
		<br>
		<?php echo $this->Paginator->pagination(array('ul' => 'pagination')); ?>
	</span>
	<?php if ($this->Paginator->numbers()): ?>
		<span class="center">
		</span>
	<?php endif; ?>
</div>
