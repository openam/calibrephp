<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $title_for_layout; ?></title>
		<?php
			echo $this->Html->charset();
			echo $this->Html->meta('description', 'Calibre Web Server');
			echo $this->Html->meta(array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0'));
			echo $this->Html->meta(array('name' => 'author', 'content' => 'Michael Tuttle'));
			echo $this->Html->meta('favicon.ico', 'http://calibre-ebook.com/favicon.ico', array('type' => 'icon'));
			echo $this->fetch('meta');

			echo $this->Html->css(array(
				'stylesheets/bootstrap',
				'stylesheets/responsive',
			));
			echo $this->fetch('css');

			echo $this->Html->script(array(
				'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
				'bootstrap-collapse',
				'jquery.fancybox.pack',
			));
			echo $this->fetch('script');
		?>
	</head>
	<body>
		<?php echo $this->element('Layout/header'); ?>
		<div class="container container-fluid">
			<div class="row-fluid">
				<div class="span3 visible-desktop">
					<?php echo $this->element('Layout/well'); ?>
				</div>
				<div class="span9">
					<?php echo $this->element('Layout/content'); ?>
				</div>
			</div>
			<hr>
			<?php echo $this->element('Layout/footer'); ?>
		</div>
		<?php
		?>
	</body>
</html>