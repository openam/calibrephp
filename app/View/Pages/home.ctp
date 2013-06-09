<div class="hero-unit">
	<h1>CalibrePHP</h1>
	<p>This is a simple web server to access a database created by the <?php echo $this->Html->link("Calibre", 'http://calibre-ebook.com/'); ?> application. CalibrePHP was written using <?php echo $this->Html->link("CakePHP", 'http://cakephp.org'); ?> in an effort to use less resources than the built in calibre web server.</p>
</div>
<div class="row-fluid">
	<div class="span4">
		<h2>Authors</h2>
		<p>View an alphabetical list of the Authors in the serve database. It's sorted by the sort field set in calibre.</p>
		<p><?php echo $this->Html->link("View Index &raquo;", array('controller'=>'authors', 'action'=>'index'), array('class' => 'btn', 'escape' => false)); ?></p>
	</div><!--/span-->
	<div class="span4">
		<h2>Books</h2>
		<p>View an alphabetical list of the Books in the serve database. The list is initally arranged by the sort field as set in calibre.</p>
		<p><?php echo $this->Html->link("View Index &raquo;", array('controller'=>'books', 'action'=>'index'), array('class' => 'btn', 'escape' => false)); ?></p>
	</div><!--/span-->
	<div class="span4">
		<h2>Publishers</h2>
		<p>View a list of the Publishers. The list is arranged alphabetically by default.</p>
		<p><?php echo $this->Html->link("View Index &raquo;", array('controller'=>'publishers', 'action'=>'index'), array('class' => 'btn', 'escape' => false)); ?></p>
	</div><!--/span-->
</div><!--/row-->
<div class="row-fluid">
	<div class="span4">
		<h2>Ratings</h2>
		<p>View a list of the available Ratings. Hopefully this will one day just provide a list of all the books arranged by rating.</p>
		<p><?php echo $this->Html->link("View Index &raquo;", array('controller'=>'ratings', 'action'=>'index'), array('class' => 'btn', 'escape' => false)); ?></p>
	</div><!--/span-->
	<div class="span4">
		<h2>Series</h2>
		<p>View a list of all the Series in the database. The list is arranged alphabetically by default.</p>
		<p><?php echo $this->Html->link("View Index &raquo;", array('controller'=>'series', 'action'=>'index'), array('class' => 'btn', 'escape' => false)); ?></p>
	</div><!--/span-->
	<div class="span4">
		<h2>Tags</h2>
		<p>View a list of all the Tags in the database. These are all the a tags that have been assigned to the books in Calibre. By default the list is arranged alphabetically.</p>
		<p><?php echo $this->Html->link("View Index &raquo;", array('controller'=>'tags', 'action'=>'index'), array('class' => 'btn', 'escape' => false)); ?></p>
	</div><!--/span-->
</div><!--/row-->

<?php
/**
 * Display debug information
 */
	if (Configure::read('debug') > 0):

		echo '<h2>Debug Info</h2>';

	/**
	 * Check Security Keys
	 */
		if (Configure::read('debug') > 0):
			Debugger::checkSecurityKeys();
		endif;

	/**
	 * PHP Version Check
	 */
		if (version_compare(PHP_VERSION, '5.2.8', '>=')):
			echo '<div class="alert alert-success">';
				echo __d('cake_dev', 'Your version of PHP is 5.2.8 or higher.');
			echo '</div>';
		else:
			echo '<div class="alert alert-error">';
				echo __d('cake_dev', 'Your version of PHP is too low. You need PHP 5.2.8 or higher to use CakePHP.');
			echo '</div>';
		endif;

	/**
	 * Temp Writeable
	 */
		if (is_writable(TMP)):
			echo '<div class="alert alert-success">';
				echo __d('cake_dev', 'Your tmp directory is writable.');
			echo '</div>';
		else:
			echo '<div class="alert alert-error">';
				echo __d('cake_dev', 'Your tmp directory is NOT writable.');
			echo '</div>';
		endif;

	/**
	 * Cache Settings
	 */
		$settings = Cache::settings();
		if (!empty($settings)):
			echo '<div class="alert alert-success">';
				echo __d('cake_dev', 'The %s is being used for core caching. To change the config edit APP/Config/core.php ', '<em>'. $settings['engine'] . 'Engine</em>');
			echo '</div>';
		else:
			echo '<div class="alert alert-error">';
				echo __d('cake_dev', 'Your cache is NOT working. Please check the settings in APP/Config/core.php');
			echo '</div>';
		endif;

	/**
	 * Database Config File
	 */
		$filePresent = null;
		if (file_exists(APP . 'Config' . DS . 'database.php')):
			echo '<div class="alert alert-success">';
				echo __d('cake_dev', 'Your database configuration file is present.');
				$filePresent = true;
			echo '</div>';
		else:
			echo '<div class="alert alert-error">';
				echo __d('cake_dev', 'Your database configuration file is NOT present.');
				echo '<br/>';
				echo __d('cake_dev', 'Rename APP/Config/database.php.default to APP/Config/database.php');
			echo '</div>';
		endif;

	/**
	 * Database Connection
	 */
		if (isset($filePresent)):
			App::uses('ConnectionManager', 'Model');
			try {
				$connected = ConnectionManager::getDataSource('default');
			} catch (Exception $connectionError) {
				$connected = false;
				$errorMsg = $connectionError->getMessage();
				if (method_exists($connectionError, 'getAttributes')) {
					$attributes = $connectionError->getAttributes();
					if (isset($errorMsg['message'])) {
						$errorMsg .= '<br />' . $attributes['message'];
					}
				}
			}

			if ($connected && $connected->isConnected()):
				echo '<div class="alert alert-success">';
		 			echo __d('cake_dev', 'Cake is able to connect to the database.');
				echo '</div>';
			else:
				echo '<div class="alert alert-error">';
					echo __d('cake_dev', 'Cake is NOT able to connect to the database.');
					echo '<br /><br />';
					echo $errorMsg;
				echo '</div>';
			endif;
		endif;

	/**
	 * PCRE
	 */
		App::uses('Validation', 'Utility');
		if (!Validation::alphaNumeric('cakephp')) {
			echo '<p><div class="alert">';
				echo __d('cake_dev', 'PCRE has not been compiled with Unicode support.');
				echo '<br/>';
				echo __d('cake_dev', 'Recompile PCRE with Unicode support by adding <code>--enable-unicode-properties</code> when configuring');
			echo '</div></p>';
		}

	/**
	 * Imagemagick
	 */
		function alist ($array) {  //This function prints a text array as an html list.
		  $alist = "<ul>";
		  for ($i = 0; $i < sizeof($array); $i++) {
		    $alist .= "<li>$array[$i]";
		  }
		  $alist .= "</ul>";
		  return $alist;
		}

		exec("convert -version", $out, $rcode); //Try to get ImageMagick "convert" program version number.

		if ($rcode == 0) {
			echo '<div class="alert alert-success">';
				echo __d('cake_dev', 'Imagemagick is installed.<br/>' . $this->Text->autoLinkUrls($out[0]));
			echo '</div>';
		} else {
			echo '<div class="alert">';
				echo __d('cake_dev', 'Imagemagick is not installed. You need to install it to get image conversion to work. On a debian based system use <em>`sudo apt-get install imagemagick`</em>.');
			echo '</div>';

		}

	/**
	 * DebugKit
	 */
		if (CakePlugin::loaded('DebugKit')):
			echo '<div class="alert alert-success">';
				echo __d('cake_dev', 'DebugKit plugin is present');
			echo '</div>';
		else:
			echo '<div class="alert">';
				echo __d('cake_dev', 'DebugKit is not installed. It will help you inspect and debug different aspects of your application. You can install it from %s', $this->Html->link('github', 'https://github.com/cakephp/debug_kit'));
			echo '</div>';
		endif;

	/**
	 * CakePHP Version Info
	 */
		echo '<div class="alert alert-info">';
			echo __d('cake_dev', 'Running on CakePHP version %s.', Configure::version());
		echo '</div>';

	/**
	 * CakePHP debug setting
	 */
		echo '<div class="alert alert-info">';
			echo __d('cake_dev', 'CakePHP debug setting is currently set at \'%s\'. To change the config edit APP/Config/core.php', Configure::read('debug'));
		echo '</div>';

endif;
?>
