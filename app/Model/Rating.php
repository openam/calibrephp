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

    /**
     * @inheritdoc
     */
    public $filterDeny = array(
        'foreignKey' => 'Rating.id',
        'associationForeignKey' => 'BooksRatingsLink.id',
        'table' => 'books_ratings_link',
        'alias' => 'BooksRatingsLink',
        'joins' => array(
            'aliases' => array(
                'books_tags_link' => 'BooksTagsLink',
                'tags' => 'Tags'
            ),
            'conditions' => array(
                'BooksTagsLink.book' => 'BooksRatingsLink.book',
                'BooksTagsLink.tag' => 'Tags.id'
            )
        )
    );

}