<?php
App::uses('AppModel', 'Model');
/**
 * Rating Model
 *
 */
class Rating extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'rating';

/**
 * Default order
 *
 * @var string
 */
	public $order = 'Rating.rating ASC';

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Book' => array(
			'className'             => 'Book',
			'joinTable'             => 'books_ratings_link',
			'foreignKey'            => 'rating',
			'associationForeignKey' => 'book',
			'unique'                => true
		)
	);

}