<div class="clear-both paginator-footer">
	<span class="center">
		<?php
			echo $this->Paginator->counter(array(
				'format' => 'Results {:start} - {:end} of {:count} | Page {:page} of {:pages}'
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
