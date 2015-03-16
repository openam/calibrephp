<?php
App::uses('AppModel', 'Model');
/**
 * Author Model
 *
 */
class Author extends AppModel {

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
	public $order = 'Author.sort ASC';

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Book' => array(
			'className'             => 'Book',
			'joinTable'             => 'books_authors_link',
			'foreignKey'            => 'author',
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
		'search' => array('type' => 'like', 'field' => array('Author.name', 'Author.sort'), 'connectorAnd' => '+', 'connectorOr' => '|'),
	);

    /**
     * @inheritdoc
     */
    public $filterDeny = array(
        'foreignKey' => 'Author.id',
        'associationForeignKey' => 'BooksAuthorsLink.id',
        'table' => 'books_authors_link',
        'alias' => 'BooksAuthorsLink',
        'joins' => array(
            'aliases' => array(
                'authors' => 'Authors',
                'books_tags_link' => 'BooksTagsLink',
                'tags' => 'Tags'
            ),
            'conditions' => array(
                'BooksAuthorsLink.author' => 'Authors.id',
                'BooksTagsLink.book' => 'BooksAuthorsLink.book',
                'BooksTagsLink.tag' => 'Tags.id'
            )
        )
    );
}
