<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
	<div class="container">
		<div class="navbar-header">
		    <?php if ($loggedIn) { ?>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only"><?php echo __('Toggle navigation'); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php } ?>

			<?php echo $this->Html->link("CalibrePHP", '/', array('class' => 'navbar-brand')); ?>
			<?php
			    if ($loggedIn) {
			        echo $this->Html->link('<i class="icon-book"></i> ' . __('Books'), array('controller' => 'books', 'action' => 'index'), array('class' => 'btn btn-default navbar-btn pull-left', 'tag' => 'button', 'escape' => false));
			    }
			?>
		</div>

		<?php if ($loggedIn) { ?>
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
						'placeholder' => __('Search'),
						'wrapInput'   => false,
						'label'       => false,
					),
				));
				echo $this->Form->input('search', array('type' => 'text'));
				echo $this->Form->end();
			?>
			<ul class="nav navbar-nav navbar-right">
				<li><?php echo $this->Html->link('<i class="icon-rss-sign"></i> ' . __('Feed'), '/opds.xml' . ($this->Session->read('Auth.User.token') ? '?key=' . $this->Session->read('Auth.User.token') : ''), array('escape' => false)); ?></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-th-list"></i> <?php echo __('Indexes'); ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li<?php echo $this->Txt->activeIndex('authors'); ?>><?php echo $this->Html->link('<i class="pull-right icon-user"></i> ' . __('Authors'), array('controller' => 'authors', 'action' => 'index'), array('escape' => false)); ?></li>
						<li<?php echo $this->Txt->activeIndex('books'); ?>><?php echo $this->Html->link('<i class="pull-right icon-book"></i> ' . __('Books'), array('controller' => 'books', 'action' => 'index'), array('escape' => false)); ?></li>
						<li<?php echo $this->Txt->activeIndex('publishers'); ?>><?php echo $this->Html->link('<i class="pull-right icon-laptop"></i> ' . __('Publishers'), array('controller' => 'publishers', 'action' => 'index'), array('escape' => false)); ?></li>
						<li<?php echo $this->Txt->activeIndex('ratings'); ?>><?php echo $this->Html->link('<i class="pull-right icon-star-half-empty"></i> ' . __('Ratings'), array('controller' => 'ratings', 'action' => 'index'), array('escape' => false)); ?></li>
						<li<?php echo $this->Txt->activeIndex('series'); ?>><?php echo $this->Html->link('<i class="pull-right icon-list-ol"></i> ' . __('Series'), array('controller' => 'series', 'action' => 'index'), array('escape' => false)); ?></li>
						<li<?php echo $this->Txt->activeIndex('tags'); ?>><?php echo $this->Html->link('<i class="pull-right icon-tags"></i> ' . __('Tags'), array('controller' => 'tags', 'action' => 'index'), array('escape' => false)); ?></li>
					</ul>
				</li>

				<li class="dropdown">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <?php echo $this->Session->read('Auth.User.username'); ?> <b class="caret"></b></a>
                	<ul class="dropdown-menu">
                		<li><?php echo $this->Html->link('<i class="pull-right icon-cog"></i> ' . __('Settings'), array('controller' => 'settings', 'action' => 'index'), array('escape' => false)); ?></li>
                		<li><?php echo $this->Html->link('<i class="pull-right icon-signout"></i> ' . __('Logout'), array('controller' => 'users', 'action' => 'logout'), array('escape' => false)); ?></li>
                	</ul>
                </li>
			</ul>
		</nav>
		<?php } ?>

	</div>
</header>
