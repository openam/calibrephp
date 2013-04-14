<?php
App::uses('BooksController', 'Controller');

/**
 * BooksController Test Case
 *
 */
class BooksControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.book',
		'app.series',
		'app.books_series_link',
		'app.comment',
		'app.datum',
		'app.author',
		'app.books_authors_link',
		'app.publisher',
		'app.books_publishers_link',
		'app.rating',
		'app.books_ratings_link',
		'app.tag',
		'app.books_tags_link'
	);

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {
	}

/**
 * testView method
 *
 * @return void
 */
	public function testView() {
	}

}