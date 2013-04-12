<?php
App::uses('Datum', 'Model');

/**
 * Datum Test Case
 *
 */
class DatumTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.datum'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Datum = ClassRegistry::init('Datum');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Datum);

		parent::tearDown();
	}

}
