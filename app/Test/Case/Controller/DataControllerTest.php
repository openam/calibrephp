<?php
App::uses('DataController', 'Controller');

/**
 * DataController Test Case
 *
 */
class DataControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.datum',
		'app.book',
		'app.comment',
		'app.identifier',
		'app.author',
		'app.books_authors_link',
		'app.publisher',
		'app.books_publishers_link',
		'app.rating',
		'app.books_ratings_link',
		'app.series',
		'app.books_series_link',
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

/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {
	}

/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {
	}

/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {
	}

}
