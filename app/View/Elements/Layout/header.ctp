<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php echo $this->Html->link("Calibre Server", '/', array('class' => 'brand')); ?>
			<div class="nav-collapse collapse hidden-desktop">
				<ul class="nav">
					<li<?php echo $this->Txt->activeIndex('authors'); ?>><?php echo $this->Html->link('Authors', array('controller' => 'authors', 'action' => 'index')); ?></li>
					<li<?php echo $this->Txt->activeIndex('books'); ?>><?php echo $this->Html->link('Books', array('controller' => 'books', 'action' => 'index')); ?></li>
					<li<?php echo $this->Txt->activeIndex('publishers'); ?>><?php echo $this->Html->link('Publishers', array('controller' => 'publishers', 'action' => 'index')); ?></li>
					<li<?php echo $this->Txt->activeIndex('ratings'); ?>><?php echo $this->Html->link('Ratings', array('controller' => 'ratings', 'action' => 'index')); ?></li>
					<li<?php echo $this->Txt->activeIndex('series'); ?>><?php echo $this->Html->link('Series', array('controller' => 'series', 'action' => 'index')); ?></li>
					<li<?php echo $this->Txt->activeIndex('tags'); ?>><?php echo $this->Html->link('Tags', array('controller' => 'tags', 'action' => 'index')); ?></li>
				</ul>
			</div>
		</div>
	</div>
</div>