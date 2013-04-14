<div class="clear-both paginator-footer">
	<span class="center">
		<?php
			echo $this->Paginator->counter(array(
				'format' => 'Results {:start} - {:end} of {:count} | Page {:page} of {:pages}'
			));
		?>
	</span>
	<?php if ($this->Paginator->numbers()): ?>
		<span class="left">
			<div class="btn-group">
				<?php echo $this->Paginator->numbers(array('class' => 'btn', 'separator' => false, 'first' => 1, 'last' => 1, 'modulus' => 3)); ?>
			</div>
		</span>
		<span class="right">
			<div class="btn-group">
				<?php
					$first     = $this->Paginator->first("<i class=\"icon-fast-backward icon-black\"></i> ", array('escape' => false, 'class' => 'btn', 'title' => 'First'));
					$prev      = $this->Paginator->prev("<i class=\"icon-backward icon-black\"></i> ", array('escape' => false, 'class' => 'btn', 'title' => 'Previous'));
					$next      = $this->Paginator->next("<i class=\"icon-forward icon-black\"></i> ", array('escape' => false, 'class' => 'btn', 'title' => 'Next'));
					$last      = $this->Paginator->last("<i class=\"icon-fast-forward icon-black\"></i> ", array('escape' => false, 'class' => 'btn', 'title' => 'Last'));

					echo $first;
					echo ($first) ? $prev : '' ;
					echo ($last)  ? $next : '' ;
					echo $last;
				?>
			</div>
		</span>
	<?php endif; ?>
</div>