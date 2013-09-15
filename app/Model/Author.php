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

}
