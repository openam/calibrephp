<?php
App::uses('AppModel', 'Model');
/**
 * Book Model
 *
 */
class Book extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';

/**
 * Default order
 *
 * @var string
 */
	public $order = 'Book.sort ASC';

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Comment' => array(
			'className'  => 'Comment',
			'foreignKey' => 'book',
			'dependent'  => true
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Datum' => array(
			'className'  => 'Datum',
			'foreignKey' => 'book',
			'dependent'  => true,
			'order'      => 'Datum.format ASC',
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Author' => array(
			'className'             => 'Author',
			'joinTable'             => 'books_authors_link',
			'foreignKey'            => 'book',
			'associationForeignKey' => 'author',
			'unique'                => true
		),
		'Publisher' => array(
			'className'             => 'Publisher',
			'joinTable'             => 'books_publishers_link',
			'foreignKey'            => 'book',
			'associationForeignKey' => 'publisher',
			'unique'                => true
		),
		'Rating' => array(
			'className'             => 'Rating',
			'joinTable'             => 'books_ratings_link',
			'foreignKey'            => 'book',
			'associationForeignKey' => 'rating',
			'unique'                => true
		),
		'Series' => array(
			'className'             => 'Series',
			'joinTable'             => 'books_series_link',
			'foreignKey'            => 'book',
			'associationForeignKey' => 'series',
			'unique'                => true
		),
		'Tag' => array(
			'className'             => 'Tag',
			'joinTable'             => 'books_tags_link',
			'foreignKey'            => 'book',
			'associationForeignKey' => 'tag',
			'unique'                => true
		)
	);

/**
 * getSummaryInfo method
 *
 * @return array
 */
	public function getSummaryInfo() {
		$cacheName        = $this->alias.'List';
		$info             = Cache::read($cacheName, 'default');
		$databaseModified = $this->getDatabaseModifiedTime();

		if (!$info || $databaseModified > $info['books']['databaseModified']) {
			Cache::clear();
			$books = $this->find('all', array());

			$info = array(
				'books' => array(
					'updated'          => date(DATE_ATOM, mktime(0, 0, 0, 1, 1, 1900)),
					'count'            => 0,
					'databaseModified' => $databaseModified,
				),
				'authors' => array(
					'updated' => date(DATE_ATOM, mktime(0, 0, 0, 1, 1, 1900)),
					'count'   => array(),
				),
				'publishers' => array(
					'updated' => date(DATE_ATOM, mktime(0, 0, 0, 1, 1, 1900)),
					'count'   => array(),
				),
				'ratings' => array(
					'updated' => date(DATE_ATOM, mktime(0, 0, 0, 1, 1, 1900)),
					'count'   => array(),
				),
				'series' => array(
					'updated' => date(DATE_ATOM, mktime(0, 0, 0, 1, 1, 1900)),
					'count'   => array(),
				),
				'tags' => array(
					'updated' => date(DATE_ATOM, mktime(0, 0, 0, 1, 1, 1900)),
					'count'   => array(),
				),
			);

			foreach ($books as $book) {
				$modified = date(DATE_ATOM, strtotime($book['Book']['last_modified']));

				/**
				 * all books
				 */
					$info['books']['count'] += 1;
					if (strtotime($modified) > strtotime($info['books']['updated'])) {
						$info['books']['updated'] = $modified;
					}
				/**
				 * authors
				 */
					if (!empty($book['Author'])) {
						foreach ($book['Author'] as $author) {
							$key = $author['sort'];

							if (strtotime($modified) > strtotime($info['authors']['updated'])) {
								$info['authors']['updated'] = $modified;
							}

							if (!isset($info['authors']['count'][$key])) {
								$info['authors']['count'][$key] = array(
									'name'    => $author['sort'],
									'id'      => $author['id'],
									'count'   => 0,
									'updated' => date(DATE_ATOM, mktime(0, 0, 0, 1, 1, 1900))
								);
							}

							if (strtotime($modified) > strtotime($info['authors']['count'][$key]['updated'])) {
								$info['authors']['count'][$key]['updated'] = $modified;
							}
							$info['authors']['count'][$key]['count'] += 1;
						}
					}
				/**
				 * publishers
				 */
					if (!empty($book['Publisher'])) {
						$key = $book['Publisher'][0]['name'];

						if (strtotime($modified) > strtotime($info['publishers']['updated'])) {
							$info['publishers']['updated'] = $modified;
						}

						if (!isset($info['publishers']['count'][$key])) {
							$info['publishers']['count'][$key] = array(
								'name'    => $book['Publisher'][0]['name'],
								'id'      => $book['Publisher'][0]['id'],
								'count'   => 0,
								'updated' => date(DATE_ATOM, mktime(0, 0, 0, 1, 1, 1900))
							);
						}

						if (strtotime($modified) > strtotime($info['publishers']['count'][$key]['updated'])) {
							$info['publishers']['count'][$key]['updated'] = $modified;
						}
						$info['publishers']['count'][$key]['count'] += 1;
					}
				/**
				 * ratings
				 */
					if (!empty($book['Rating'])) {
						$key = $book['Rating'][0]['rating'];

						if (strtotime($modified) > strtotime($info['ratings']['updated'])) {
							$info['ratings']['updated'] = $modified;
						}

						if (!isset($info['ratings']['count'][$key])) {
							$info['ratings']['count'][$key] = array(
								'name'    => $book['Rating'][0]['rating'] / 2,
								'id'      => $book['Rating'][0]['id'],
								'count'   => 0,
								'updated' => date(DATE_ATOM, mktime(0, 0, 0, 1, 1, 1900))
							);
						}

						if (strtotime($modified) > strtotime($info['ratings']['count'][$key]['updated'])) {
							$info['ratings']['count'][$key]['updated'] = $modified;
						}
						$info['ratings']['count'][$key]['count'] += 1;
					}
				/**
				 * series
				 */
					if (!empty($book['Series'])) {
						$series = $book['Series'][0]['id'];

						if (strtotime($modified) > strtotime($info['series']['updated'])) {
							$info['series']['updated'] = $modified;
						}

						if (!isset($info['series']['count'][$series])) {
							$info['series']['count'][$series] = array(
								'name'    => $book['Series'][0]['sort'],
								'id'      => $book['Series'][0]['id'],
								'count'   => 0,
								'updated' => date(DATE_ATOM, mktime(0, 0, 0, 1, 1, 1900))
							);
						}

						if (strtotime($modified) > strtotime($info['series']['count'][$series]['updated'])) {
							$info['series']['count'][$series]['updated'] = $modified;
						}
						$info['series']['count'][$series]['count'] += 1;
					}
				/**
				 * tags
				 */
					if (!empty($book['Tag'])) {
						foreach ($book['Tag'] as $tag) {
							$key = $tag['name'];

							if (strtotime($modified) > strtotime($info['tags']['updated'])) {
								$info['tags']['updated'] = $modified;
							}

							if (!isset($info['tags']['count'][$key])) {
								$info['tags']['count'][$key] = array(
									'name'    => $tag['name'],
									'id'      => $tag['id'],
									'count'   => 0,
									'updated' => date(DATE_ATOM, mktime(0, 0, 0, 1, 1, 1900))
								);
							}

							if (strtotime($modified) > strtotime($info['tags']['count'][$key]['updated'])) {
								$info['tags']['count'][$key]['updated'] = $modified;
							}
							$info['tags']['count'][$key]['count'] += 1;
						}
					}
			}

			/**
			 * Sort the info['publishers, ratings, series']
			 */
				foreach ($info as $key => $value) {
					if (is_array($value['count'])) {
						$temp = $value['count'];
						ksort($temp);
						$info[$key]['count'] = $temp;
					}
				}

				Cache::write($cacheName, $info, 'default');
				Cache::write('databaseModified', $info['books']['databaseModified'], 'default');
			}

			return $info;
	}

}