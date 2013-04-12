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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Series' => array(
			'className'  => 'Series',
			'foreignKey' => 'series_index',
		)
	);

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
		'Tag' => array(
			'className'             => 'Tag',
			'joinTable'             => 'books_tags_link',
			'foreignKey'            => 'book',
			'associationForeignKey' => 'tag',
			'unique'                => true
		)
	);

}