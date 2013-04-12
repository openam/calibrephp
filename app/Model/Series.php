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

}