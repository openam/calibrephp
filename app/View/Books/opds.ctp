<div class="jumbotron">
	<h1>CalibrePHP</h1>
	<p>This is a simple <?php echo $this->Html->link('HTML', 'http://en.wikipedia.org/wiki/HTML'); ?> and <?php echo $this->Html->link('OPDS', 'http://en.wikipedia.org/wiki/OPDS'); ?> web server to access a database created by the <?php echo $this->Html->link("Calibre", 'http://calibre-ebook.com/'); ?> application. CalibrePHP was written using <?php echo $this->Html->link("CakePHP", 'http://cakephp.org'); ?>.</p>
</div>
<div class="row">
	<div class="col col-lg-4">
		<h2><?php echo $this->Html->link('<i class="pull-right icon-user"></i><span class="badge pull-right">' . $info['authors']['summary']['count'] . '</span> Authors', array('controller'=>'authors', 'action'=>'index'), array('escape' => false)); ?></h2>
		<p>View an alphabetical list of the Authors in the serve database. It's sorted by the sort field set in calibre.</p>
	</div><!--/span-->
	<div class="col col-lg-4">
		<h2><?php echo $this->Html->link('<i class="pull-right icon-book"></i><span class="badge pull-right">' . $info['books']['summary']['count'] . '</span> Books', array('controller'=>'books', 'action'=>'index'), array('escape' => false)); ?></h2>
		<p>View an alphabetical list of the Books in the serve database. The list is initally arranged by the sort field as set in calibre.</p>
	</div><!--/span-->
	<div class="col col-lg-4">
		<h2><?php echo $this->Html->link('<i class="pull-right icon-laptop"></i><span class="badge pull-right">' . $info['publishers']['summary']['count'] . '</span> Publishers', array('controller'=>'publishers', 'action'=>'index'), array('escape' => false)); ?></h2>
		<p>View a list of the Publishers. The list is arranged alphabetically by default.</p>
	</div><!--/span-->
</div><!--/row-->
<div class="row">
	<div class="col col-lg-4">
		<h2><?php echo $this->Html->link('<i class="pull-right icon-star-half-empty"></i><span class="badge pull-right">' . $info['ratings']['summary']['count'] . '</span> Ratings', array('controller'=>'ratings', 'action'=>'index'), array('escape' => false)); ?></h2>
		<p>View a list of the available Ratings. Hopefully this will one day just provide a list of all the books arranged by rating.</p>
	</div><!--/span-->
	<div class="col col-lg-4">
		<h2><?php echo $this->Html->link('<i class="pull-right icon-list-ol"></i><span class="badge pull-right">' . $info['series']['summary']['count'] . '</span> Series', array('controller'=>'series', 'action'=>'index'), array('escape' => false)); ?></h2>
		<p>View a list of all the Series in the database. The list is arranged alphabetically by default.</p>
	</div><!--/span-->
	<div class="col col-lg-4">
		<h2><?php echo $this->Html->link('<i class="pull-right icon-tags"></i><span class="badge pull-right">' . $info['tags']['summary']['count'] . '</span> Tags', array('controller'=>'tags', 'action'=>'index'), array('escape' => false)); ?></h2>
		<p>View a list of all the Tags in the database. These are all the a tags that have been assigned to the books in Calibre. By default the list is arranged alphabetically.</p>
	</div><!--/span-->
</div><!--/row-->
