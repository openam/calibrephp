<div class="jumbotron">
	<h1>CalibrePHP</h1>
	<p>Это просто <?php echo $this->Html->link('HTML', 'http://en.wikipedia.org/wiki/HTML'); ?> и <?php echo $this->Html->link('OPDS', 'http://en.wikipedia.org/wiki/OPDS'); ?> веб-сервер для доступа к базе данных, созданной приложением <?php echo $this->Html->link("Calibre", 'http://calibre-ebook.com/'); ?>. CalibrePHP была написана с использованием <?php echo $this->Html->link("CakePHP", 'http://cakephp.org'); ?>.</p>
</div>
<div class="row">
	<div class="col col-lg-4">
		<h2><?php echo $this->Html->link('<i class="pull-right icon-user"></i><span class="badge pull-right">' . $info['authors']['summary']['count'] . '</span> Авторы', array('controller'=>'authors', 'action'=>'index'), array('escape' => false)); ?></h2>
		<p>Просмотр алфавитного списока авторов. Используется поле сортировки заданный в Calibre.</p>
	</div><!--/span-->
	<div class="col col-lg-4">
		<h2><?php echo $this->Html->link('<i class="pull-right icon-book"></i><span class="badge pull-right">' . $info['books']['summary']['count'] . '</span> Книги', array('controller'=>'books', 'action'=>'index'), array('escape' => false)); ?></h2>
		<p>Просмотр алфавитного списка книг. Используется поле сортировки заданный в Calibre.</p>
	</div><!--/span-->
	<div class="col col-lg-4">
		<h2><?php echo $this->Html->link('<i class="pull-right icon-laptop"></i><span class="badge pull-right">' . $info['publishers']['summary']['count'] . '</span> Издатели', array('controller'=>'publishers', 'action'=>'index'), array('escape' => false)); ?></h2>
		<p>Просмотр списка издателей. Используется список в алфавитном порядке.</p>
	</div><!--/span-->
</div><!--/row-->
<div class="row">
	<div class="col col-lg-4">
		<h2><?php echo $this->Html->link('<i class="pull-right icon-star-half-empty"></i><span class="badge pull-right">' . $info['ratings']['summary']['count'] . '</span> Рейтинги', array('controller'=>'ratings', 'action'=>'index'), array('escape' => false)); ?></h2>
		<p>Просмотр списка доступных рейтингов. Используется поле сортировки по рейтингу книг.</p>
	</div><!--/span-->
	<div class="col col-lg-4">
		<h2><?php echo $this->Html->link('<i class="pull-right icon-list-ol"></i><span class="badge pull-right">' . $info['series']['summary']['count'] . '</span> Жанры', array('controller'=>'series', 'action'=>'index'), array('escape' => false)); ?></h2>
		<p>Просмотр списка всех жанров. Используется список в алфавитном порядке.</p>
	</div><!--/span-->
	<div class="col col-lg-4">
		<h2><?php echo $this->Html->link('<i class="pull-right icon-tags"></i><span class="badge pull-right">' . $info['tags']['summary']['count'] . '</span> Теги', array('controller'=>'tags', 'action'=>'index'), array('escape' => false)); ?></h2>
		<p>Просмотреть список тегов. Используются все теги назначеные для книг в Calibre. По умолчанию используется список в алфавитном порядке.</p>
	</div><!--/span-->
</div><!--/row-->
