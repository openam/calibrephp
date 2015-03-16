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
     * Rule filter deny tags.
     *
     * @var array
     * @access public
     */
    public $filterDeny = array();

    /**
     * Deny tags parsing list.
     *
     * @var array
     * @access private
     */
    private $filterDenyTags = array();

    /**
     * Apply filter deny tags.
     *
     * @inheritdoc
     */
    public function __construct($id = false, $table = null, $ds = null)
    {
        parent::__construct($id, $table , $ds);

        if (empty($this->filterDenyTags)) {
            if (($deny = CakeSession::read('Auth.User.deny')) !== null) {

                // add sql string Tags.name LIKE '%rule%'
                $this->filterDenyTags = array_map(function($value) {
                    return('Tags.name LIKE \'%' . addslashes(strtolower(trim($value))) . '%\'' );
                }, array_filter(explode(',', $deny . ',')));
            }

            foreach($this->associations() as $associations) {
                foreach($this->{$associations} as $model => $association) {
                    if (isset($association['className'])) {
                        $this->{$associations}{$model} = $this->{$association['className']}->beforeFind($association);
                    }
                }
            }
        }
    }

    /**
     * Add conditions rule for filtering results.
     *
     * @inheritdoc
     */
    public function beforeFind($query) {
        if (!empty($this->filterDeny) && !empty($this->filterDenyTags)) {

            // example sql Author.id NOT IN (SELECT BooksAuthorsLink.id FROM books_authors_link AS BooksAuthorsLink
            $conditions = $this->filterDeny['foreignKey']
                . ' NOT IN (SELECT ' . $this->filterDeny['associationForeignKey']
                . ' FROM ' . $this->filterDeny['table']
                . (isset($this->filterDeny['alias']) ? ' AS ' . $this->filterDeny['alias'] : '');

            if (isset($this->filterDeny['joins'])) {
                $joins = $this->filterDeny['joins']['aliases'];

                // add joins sql string JOIN authors as Authors
                $conditions .= array_reduce($joins, function($last, $item) use($joins) {
                    return ($last . ' JOIN ' . array_search($item, $joins) . ' AS ' . $item);
                });

                $joinConditions = $this->filterDeny['joins']['conditions'];

                // add joins sql string ON (BooksAuthorsLink.author=Authors.id AND BooksTagsLink.tag=Tags.id)
                $conditions .= ' ON (' . array_reduce($joinConditions, function($last, $item) use($joinConditions) {
                    return ($last . (!empty($last) ? ' AND ' : '') . array_search($item, $joinConditions) . '=' . $item);
                }) . ')';
            }

            // add where sql string WHERE Tags.name LIKE '%rule%' OR Tags.name LIKE '%rule%'
            $query['conditions'][] = $conditions . ' WHERE ' . implode(' OR ', $this->filterDenyTags) . ')';
        }
        return ($query);
    }

/**
 * getCalibrePath method
 * @return string with path to calibre location
 */
	public function getCalibrePath() {
		$databasePath = $this->getCalibreDatabasePath();
		return preg_replace('/metadata.db/', '', $databasePath);
	}

/**
 * getCalibreDatabasePath method
 * @return string with path to database
 */
	public function getCalibreDatabasePath() {
		return $this->getDataSource('Default')->config['database'];
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
