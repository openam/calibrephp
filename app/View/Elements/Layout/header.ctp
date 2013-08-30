<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php echo $this->Html->link("CalibrePHP", '/', array('class' => 'navbar-brand')); ?>
		</div>
		<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
			<ul class="nav navbar-nav">
		<li<?php echo $this->Txt->activeIndex('authors'); ?>><?php echo $this->Html->link('Authors', array('controller' => 'authors', 'action' => 'index')); ?></li>
		<li<?php echo $this->Txt->activeIndex('books'); ?>><?php echo $this->Html->link('Books', array('controller' => 'books', 'action' => 'index')); ?></li>
		<li<?php echo $this->Txt->activeIndex('publishers'); ?>><?php echo $this->Html->link('Publishers', array('controller' => 'publishers', 'action' => 'index')); ?></li>
		<li<?php echo $this->Txt->activeIndex('ratings'); ?>><?php echo $this->Html->link('Ratings', array('controller' => 'ratings', 'action' => 'index')); ?></li>
		<li<?php echo $this->Txt->activeIndex('series'); ?>><?php echo $this->Html->link('Series', array('controller' => 'series', 'action' => 'index')); ?></li>
		<li<?php echo $this->Txt->activeIndex('tags'); ?>><?php echo $this->Html->link('Tags', array('controller' => 'tags', 'action' => 'index')); ?></li>
			</ul>
		</nav>
	</div>
</header>
