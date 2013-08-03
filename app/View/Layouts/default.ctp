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
				'bootstrap-dropdown',
				'jquery.fancybox.pack',
				'share',
			));
			echo $this->fetch('script');
		?>
	</head>
	<body>
		<div class="wrapper">
			<?php echo $this->element('Layout/header'); ?>
			<div class="container container-fluid">
				<div class="row-fluid first-row">
					<div class="span3 visible-desktop">
						<?php echo $this->element('Layout/well'); ?>
					</div>
					<div class="span9 full-width-non-desktop">
						<?php echo $this->element('Layout/content'); ?>
					</div>
				</div>
			</div>
			<div class="push"></div>
		</div>
		<div class="container container-fluid">
			<?php echo $this->element('Layout/footer'); ?>
		</div>
	</body>
</html>
