<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

/**
 * getCalibrePath method
 * @return string with path to calibre location
 */
	public function getCalibrePath() {
		return Configure::read('Settings.Default.CalibrePath');
	}

/**
 * getCalibreDatabasePath method
 * @return string with path to database
 */
	public function getCalibreDatabasePath() {
		return $this->getCalibrePath() . 'metadata.db';
	}

/**
 * getDatabaseModifiedTime method
 * @return string with unix time stamp of when the database was last modified
 */
	public function getDatabaseModifiedTime() {
		return filemtime($this->getCalibreDatabasePath());
	}

}
