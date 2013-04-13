<?php
App::uses('Publisher', 'Model');

/**
 * Publisher Test Case
 *
 */
class PublisherTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.publisher'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Publisher = ClassRegistry::init('Publisher');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Publisher);

		parent::tearDown();
	}

}
