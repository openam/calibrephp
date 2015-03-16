<?php
App::uses('AppModel', 'Model');
/**
 * Tag Model
 *
 */
class Tag extends AppModel {

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
	public $order = 'Tag.name ASC';

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Book' => array(
			'className'             => 'Book',
			'joinTable'             => 'books_tags_link',
			'foreignKey'            => 'tag',
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
		'search' => array('type' => 'like', 'field' => array('Tag.name'), 'connectorAnd' => '+', 'connectorOr' => '|'),
	);

    /**
     * @inheritdoc
     */
    public $filterDeny = array(
        'foreignKey' => 'Tag.id',
        'associationForeignKey' => 'Tags.id',
        'table' => 'tags',
        'alias' => 'Tags'
    );
}
