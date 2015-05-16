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
			echo '<div class="alert alert-danger">';
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
			echo '<div class="alert alert-danger">';
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
			echo '<div class="alert alert-danger">';
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
			echo '<div class="alert alert-danger">';
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
				echo '<div class="alert alert-danger">';
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
			echo '<p><div class="alert alert-danger">';
				echo __d('cake_dev', 'PCRE has not been compiled with Unicode support.');
				echo '<br/>';
				echo __d('cake_dev', 'Recompile PCRE with Unicode support by adding <code>--enable-unicode-properties</code> when configuring');
			echo '</div></p>';
		}

	/**
	 * GD image library
	 */
		if (extension_loaded('gd') && function_exists('gd_info')) {
			echo '<div class="alert alert-success">';
				$info = gd_info();
				echo __d('cake_dev', 'GD Version: ' . $info['GD Version'] . ' is installed.');
			echo '</div>';
		} else {
			echo '<div class="alert alert-danger">';
				echo __d('cake_dev', 'GD image library is not installed. You need to install it to get image conversion to work.');
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
			echo '<div class="alert alert-danger">';
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
