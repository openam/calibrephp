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

}