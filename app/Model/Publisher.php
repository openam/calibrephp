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

}