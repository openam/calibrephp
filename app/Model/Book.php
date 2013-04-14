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

}