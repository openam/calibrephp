<div class="well sidebar-nav affix">
	<ul class="nav nav-list">
		<li class="nav-header">Indexes</li>
		<li<?php echo $this->Txt->activeIndex('authors'); ?>><?php echo $this->Html->link('Authors', array('controller' => 'authors', 'action' => 'index')); ?></li>
		<li<?php echo $this->Txt->activeIndex('books'); ?>><?php echo $this->Html->link('Books', array('controller' => 'books', 'action' => 'index')); ?></li>
		<li<?php echo $this->Txt->activeIndex('publishers'); ?>><?php echo $this->Html->link('Publishers', array('controller' => 'publishers', 'action' => 'index')); ?></li>
		<li<?php echo $this->Txt->activeIndex('ratings'); ?>><?php echo $this->Html->link('Ratings', array('controller' => 'ratings', 'action' => 'index')); ?></li>
		<li<?php echo $this->Txt->activeIndex('series'); ?>><?php echo $this->Html->link('Series', array('controller' => 'series', 'action' => 'index')); ?></li>
		<li<?php echo $this->Txt->activeIndex('tags'); ?>><?php echo $this->Html->link('Tags', array('controller' => 'tags', 'action' => 'index')); ?></li>
	</ul>
</div>