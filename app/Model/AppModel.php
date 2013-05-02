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

/**
 * getInfo
 *
 * @return array with
 */
	public function getInfo() {
		$cacheName = $this->alias.'Info';
		$model     = Cache::read($cacheName, 'default');

		if (!$model || $this->getDatabaseModifiedTime() > $model['summary']['updated']) {

			if ($this->alias == 'Book') {
				$this->recursive = -1;
			} else {
				$this->recursive = 1;
			}
			$items = $this->find('all');

			$model = array(
				'summary' => array(
					'updated' => date(DATE_ATOM, mktime(0, 0, 0, 1, 1, 1900)),
					'count' => 0,
				),
				$this->alias => array()
			);

			foreach ($items as $item) {
				if (isset($item[$this->alias]['sort']) && $item[$this->alias]['sort']) {
					$displayName = 'sort';
				} elseif (isset($item[$this->alias]['rating'])) {
					$displayName = 'rating';
				} else {
					$displayName = 'name';
				}

				$key = $item[$this->alias]['id'];
				if (!isset($model[$this->alias][$key])) {
					$model[$this->alias][$key] = array(
						'name'    => $item[$this->alias][$displayName],
						'id'      => $key,
						'count'   => 0,
						'updated' => date(DATE_ATOM, mktime(0, 0, 0, 1, 1, 1900))
					);
				}

				switch ($this->alias) {
					case 'Book':
						$modified = date(DATE_ATOM, strtotime($item['Book']['last_modified']));

						// Overall
						if (strtotime($modified) > strtotime($model['summary']['updated'])) {
							$model['summary']['updated'] = $modified;
						}

						//Specific
						if (strtotime($modified) > strtotime($model[$this->alias][$key]['updated'])) {
							$model[$this->alias][$key]['updated'] = $modified;
						}

						$model[$this->alias][$key]['count'] += 1;
						$model['summary']['count']          += 1;

						break;

					default:
						foreach ($item['Book'] as $book) {
							$modified = date(DATE_ATOM, strtotime($book['last_modified']));

							// Overall
							if (strtotime($modified) > strtotime($model['summary']['updated'])) {
								$model['summary']['updated'] = $modified;
							}

							//Specific
							if (strtotime($modified) > strtotime($model[$this->alias][$key]['updated'])) {
								$model[$this->alias][$key]['updated'] = $modified;
							}

							$model[$this->alias][$key]['count'] += 1;
						}
						$model['summary']['count'] += 1;
						break;
				}
			}

			Cache::write($cacheName, $model, 'default');
		}

		return $model;
	}

}
