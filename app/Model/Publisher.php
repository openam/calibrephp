<?php
App::uses('AppModel', 'Model');
/**
 * Publisher Model
 *
 */
class Publisher extends AppModel {

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
	public $order = 'Publisher.name ASC';

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Book' => array(
			'className'             => 'Book',
			'joinTable'             => 'books_publishers_link',
			'foreignKey'            => 'publisher',
			'associationForeignKey' => 'book',
			'unique'                => true
		)
	);

/**
 * filterArgs for Search
 *
 * @var array
 */
	public $filterArgs = array(
		'search' => array('type' => 'like', 'field' => array('Publisher.name'), 'connectorAnd' => '+', 'connectorOr' => '|'),
	);

    /**
     * @inheritdoc
     */
    public $filterDeny = array(
        'foreignKey' => 'Publisher.id',
        'associationForeignKey' => 'BooksPublishersLink.id',
        'table' => 'books_publishers_link',
        'alias' => 'BooksPublishersLink',
        'joins' => array(
            'aliases' => array(
                'books_tags_link' => 'BooksTagsLink',
                'tags' => 'Tags'
            ),
            'conditions' => array(
                'BooksTagsLink.book' => 'BooksPublishersLink.book',
                'BooksTagsLink.tag' => 'Tags.id'
            )
        )
    );

}
