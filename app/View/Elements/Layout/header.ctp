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
			<?php echo $this->Html->link('<i class="icon-book"></i> Books', array('controller' => 'books', 'action' => 'index'), array('class' => 'btn btn-default navbar-btn pull-left', 'tag' => 'button', 'escape' => false)); ?>
		</div>
		<nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
			<ul class="nav navbar-nav">
			</ul>
			<?php
				echo $this->Form->create(Inflector::camelize(Inflector::singularize($this->request->controller)), array(
					'url'           => array('controller' => 'books', 'action' => 'search'),
					'class'         => 'navbar-form navbar-left',
					'role'          => 'search',
					'inputDefaults' => array(
						'div'         => 'form-group',
						'class'       => 'form-control',
						'placeholder' => 'Search',
						'wrapInput'   => false,
						'label'       => false,
					),
				));
				echo $this->Form->input('search', array('type' => 'text'));
				echo $this->Form->end();
			?>
			<ul class="nav navbar-nav navbar-right">
				<li><?php echo $this->Html->link('<i class="icon-rss-sign"></i> Feed', '/opds.xml', array('escape' => false)); ?></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th-list"></i> Indexes <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li<?php echo $this->Txt->activeIndex('authors'); ?>><?php echo $this->Html->link('<i class="pull-right icon-user"></i> Authors', array('controller' => 'authors', 'action' => 'index'), array('escape' => false)); ?></li>
						<li<?php echo $this->Txt->activeIndex('books'); ?>><?php echo $this->Html->link('<i class="pull-right icon-book"></i> Books', array('controller' => 'books', 'action' => 'index'), array('escape' => false)); ?></li>
						<li<?php echo $this->Txt->activeIndex('publishers'); ?>><?php echo $this->Html->link('<i class="pull-right icon-laptop"></i> Publishers', array('controller' => 'publishers', 'action' => 'index'), array('escape' => false)); ?></li>
						<li<?php echo $this->Txt->activeIndex('ratings'); ?>><?php echo $this->Html->link('<i class="pull-right icon-star-half-empty"></i> Ratings', array('controller' => 'ratings', 'action' => 'index'), array('escape' => false)); ?></li>
						<li<?php echo $this->Txt->activeIndex('series'); ?>><?php echo $this->Html->link('<i class="pull-right icon-list-ol"></i> Series', array('controller' => 'series', 'action' => 'index'), array('escape' => false)); ?></li>
						<li<?php echo $this->Txt->activeIndex('tags'); ?>><?php echo $this->Html->link('<i class="pull-right icon-tags"></i> Tags', array('controller' => 'tags', 'action' => 'index'), array('escape' => false)); ?></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</header>
