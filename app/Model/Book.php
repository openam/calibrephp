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
 * Behaviors
 *
 * @var array
 */
	public $actsAs = array(
		'Search.Searchable',
	);

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
		),
		'Identifier' => array(
			'className'  => 'Identifier',
			'foreignKey' => 'book',
			'dependent'  => true,
			'order'      => 'Identifier.type ASC',
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

		if (!$info || $databaseModified > $info['books']['summary']['updated']) {
			Cache::clear();

			$info = array(
				'books'      => $this->getInfo(),
				'authors'    => $this->Author->getInfo(),
				'publishers' => $this->Publisher->getInfo(),
				'ratings'    => $this->Rating->getInfo(),
				'series'     => $this->Series->getInfo(),
				'tags'       => $this->Tag->getInfo()
			);

			Cache::write($cacheName, $info, 'default');
		}

		return $info;
	}

/**
 * filterArgs for Search
 *
 * @var array
 */
	public $filterArgs = array(
		'search' => array('type' => 'like', 'field' => array('Book.title', 'Book.sort'), 'connectorAnd' => '+', 'connectorOr' => '|'),
	);

    /**
     * @inheritdoc
     */
    public $filterDeny = array(
        'foreignKey' => 'Book.id',
        'associationForeignKey' => 'BooksTagsLink.book',
        'table' => 'books_tags_link',
        'alias' => 'BooksTagsLink',
        'joins' => array(
            'aliases' => array(
                'tags' => 'Tags'
            ),
            'conditions' => array(
                'BooksTagsLink.tag' => 'Tags.id'
            )
        )
    );
}
