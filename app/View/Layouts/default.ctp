<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $title_for_layout; ?></title>
		<?php
			echo $this->Html->charset();
			echo $this->Html->meta('description', 'Calibre Web Server');
			echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'));
			echo $this->Html->meta(array('name' => 'author', 'content' => 'Michael Tuttle'));
			echo $this->Html->meta('favicon.ico', '/favicon.ico', array('type' => 'icon'));
			echo $this->fetch('meta');

			echo $this->Html->css(array(
				'stylesheets/bootstrap',
				'font/font-awesome.css',
			));
			echo $this->fetch('css');

			echo $this->Html->script(array(
				'jquery.min.js',
				'bootstrap.min.js',
				'jquery.fancybox.pack',
				'share',
			));
			echo $this->fetch('script');
		?>
	</head>
	<body>
		<div class="wrapper">
			<?php echo $this->element('Layout/header'); ?>
			<div class="container">
				<!-- <div class="row"> -->
					<!-- <div class="col col-lg-12"> -->
						<?php echo $this->element('Layout/content'); ?>
						<?php echo $this->element('debug'); ?>
					<!-- </div> -->
				<!-- </div> -->
			</div>
			<div class="push"></div>
		</div>
		<div class="container">
			<?php echo $this->element('Layout/footer'); ?>
		</div>
	</body>
</html>
