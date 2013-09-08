<?php
App::uses('AppModel', 'Model');
/**
 * Datum Model
 *
 */
class Datum extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'format';

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Book' => array(
			'className'  => 'Book',
			'foreignKey' => 'book',
		)
	);

}
