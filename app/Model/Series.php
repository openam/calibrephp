<?php
App::uses('AppModel', 'Model');
/**
 * Series Model
 *
 */
class Series extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

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
	public $order = 'Series.sort ASC';

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Book' => array(
			'className'             => 'Book',
			'joinTable'             => 'books_series_link',
			'foreignKey'            => 'series',
			'associationForeignKey' => 'book',
			'unique'                => true,
			'order'                 => array('Book.series_index' => 'ASC')
		)
	);

/**
 * filterArgs for Search
 *
 * @var array
 */
	public $filterArgs = array(
		'search' => array('type' => 'like', 'field' => array('Series.name', 'Series.sort'), 'connectorAnd' => '+', 'connectorOr' => '|'),
	);

    /**
     * @inheritdoc
     */
    public $filterDeny = array(
        'foreignKey' => 'Series.id',
        'associationForeignKey' => 'BooksSeriesLink.id',
        'table' => 'books_series_link',
        'alias' => 'BooksSeriesLink',
        'joins' => array(
            'aliases' => array(
                'books_tags_link' => 'BooksTagsLink',
                'tags' => 'Tags'
            ),
            'conditions' => array(
                'BooksTagsLink.book' => 'BooksSeriesLink.book',
                'BooksTagsLink.tag' => 'Tags.id'
            )
        )
    );

}
