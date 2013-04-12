<?php
App::uses('Series', 'Model');

/**
 * Series Test Case
 *
 */
class SeriesTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.series'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Series = ClassRegistry::init('Series');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Series);

		parent::tearDown();
	}

}
